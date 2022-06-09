<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Contracts\EventContract;
use App\Contracts\CategoryContract;
use App\Contracts\EventformatContract;
use App\Contracts\LanguageContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EventExport;
class EventController extends BaseController
{
    /**
     * @var EventContract
     */
    protected $eventRepository;
    /**
     * @var CategoryContract
     */
    protected $categoryRepository;
    /**
     * @var EventformatContract
     */
    protected $eventformatRepository;
    /**
     * @var LanguageContract
     */
    protected $languageRepository;


    /**
     * EventController constructor.
     * @param EventContract $eventRepository
     * @param CategoryContract $categoryRepository
     * @param EventformatContract $eventformatRepository
     * @param LanguageContract $languageRepository
     */
    public function __construct(EventContract $eventRepository,CategoryContract $categoryRepository, EventformatContract $eventformatRepository, LanguageContract $languageRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->categoryRepository = $categoryRepository;
        $this->eventformatRepository = $eventformatRepository;
        $this->languageRepository = $languageRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $events = $this->eventRepository->getEventsByBusiness(Auth::user()->id);

        $this->setPageTitle('Event', 'List of all event');
        return view('business.event.index', compact('events'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->categoryRepository->listCategories();
        $eventformats = $this->eventformatRepository->listEventformats();
        $languages = $this->languageRepository->listLanguages();

        $this->setPageTitle('Event', 'Create Event');
        return view('business.event.create', compact('categories','eventformats','languages'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191',
            'image'     =>  'required|mimes:jpg,jpeg,png|max:1000',
        ]);

        $params = $request->except('_token');

        $event = $this->eventRepository->createEvent($params);

        if (!$event) {
            return $this->responseRedirectBack('Error occurred while creating event.', 'error', true, true);
        }
        return $this->responseRedirect('business.event.index', 'Event has been added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetEvent = $this->eventRepository->findEventById($id);
        $categories = $this->categoryRepository->listCategories();
        $eventformats = $this->eventformatRepository->listEventformats();
        $languages = $this->languageRepository->listLanguages();

        $this->setPageTitle('Event', 'Edit Event : '.$targetEvent->title);
        return view('business.event.edit', compact('targetEvent','categories','eventformats','languages'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191',
        ]);

        $params = $request->except('_token');

        $event = $this->eventRepository->updateEvent($params);

        if (!$event) {
            return $this->responseRedirectBack('Error occurred while updating event.', 'error', true, true);
        }
        return $this->responseRedirectBack('Event has been updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $event = $this->eventRepository->deleteEvent($id);

        if (!$event) {
            return $this->responseRedirectBack('Error occurred while deleting event.', 'error', true, true);
        }
        return $this->responseRedirect('business.event.index', 'Event has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $events = $this->eventRepository->detailsEvent($id);
        $event = $events[0];

        $this->setPageTitle('Event', 'Event Details : '.$event->title);
        return view('business.event.details', compact('event'));
    }



    public function csvStore(Request $request)
    {
        if (!empty($request->file)) {
            // if ($request->input('submit') != null ) {
            $file = $request->file('file');
            // File Details
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");
            // 50MB in Bytes
            $maxFileSize = 50097152;
            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {
                // Check file size
                if ($fileSize <= $maxFileSize) {
                    // File upload location
                    $location = 'business/uploads/csv';
                    // Upload file
                    $file->move($location, $filename);
                    // Import CSV to Database
                    $filepath = public_path($location . "/" . $filename);
                    // Reading file
                    $file = fopen($filepath, "r");
                    $importData_arr = array();
                    $i = 0;
                    while (($filedata = fgetcsv($file, 10000, ",")) !== FALSE) {
                        $num = count($filedata);
                        // Skip first row
                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // echo '<pre>';print_r($importData_arr);exit();

                    // Insert into database
                    foreach ($importData_arr as $importData) {
                        $storeData = 0;
                        if(isset($importData[1]) == "Carry In") $storeData = 1;

                        $insertData = array(
                            "title" => isset($importData[0]) ? $importData[0] : null,
                            "address" => isset($importData[1]) ? $importData[1] : null,
                            "lat" => isset($importData[2]) ? $importData[2] : null,
                            "lon" => isset($importData[3]) ? $importData[3] : null,
                            "pin" => isset($importData[4]) ? $importData[4] : null,
                            "start_date" => isset($importData[5]) ? $importData[5] : null,
                            "end_date" => isset($importData[6]) ? $importData[6] : null,
                            "start_time" => isset($importData[7]) ? $importData[7] : null,
                            "end_time" => isset($importData[8]) ? $importData[8] : null,
                            "description" => isset($importData[9]) ? $importData[9] : null,
                            "contact_email" => isset($importData[10]) ? $importData[10] : null,
                            "contact_phone" => isset($importData[11]) ? $importData[11] : null,
                            "website" => isset($importData[12]) ? $importData[12] : null,
                            "price" => isset($importData[13]) ? $importData[13] : null,
                            "is_recurring" => isset($importData[14]) ? $importData[14] : null,
                            "no_of_followers" => isset($importData[15]) ? $importData[15] : null,
                            // "slug" => isset($importData[16]) ? $importData[16] : null,
                            // "slug" => isset($importData[17]) ? $importData[17] : null,

                        );
                        // echo '<pre>';print_r($insertData);exit();
                        State::insertData($insertData);
                    }
                    Session::flash('message', 'Import Successful.');
                } else {
                    Session::flash('message', 'File too large. File must be less than 50MB.');
                }
            } else {
                Session::flash('message', 'Invalid File Extension. supported extensions are ' . implode(', ', $valid_extension));
            }
        } else {
            Session::flash('message', 'No file found.');
        }
        return redirect()->route('business.event.index');
    }

    public function export()
    {
        return Excel::download(new EventExport, 'event.xlsx');
    }

}
