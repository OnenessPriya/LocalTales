<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Contracts\DealContract;
use App\Contracts\CategoryContract;
use App\Contracts\BusinessContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;
use App\Exports\DealExport;
use Maatwebsite\Excel\Facades\Excel;

class DealController extends BaseController
{
    /**
     * @var DealContract
     */
    protected $dealRepository;
    /**
     * @var CategoryContract
     */
    protected $categoryRepository;
    /**
     * @var BusinessContract
     */
    protected $businessRepository;


    /**
     * NotificationController constructor.
     * @param DealContract $dealRepository
     */
    public function __construct(DealContract $dealRepository,CategoryContract $categoryRepository,BusinessContract $businessRepository)
    {
        $this->dealRepository = $dealRepository;
        $this->categoryRepository = $categoryRepository;
        $this->businessRepository = $businessRepository;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $deals = $this->dealRepository->getDealsByBusiness(Auth::user()->id);

        $this->setPageTitle('Deal', 'List of all deals');
        return view('business.deal.index', compact('deals'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->categoryRepository->listCategories();
        $businesses = $this->businessRepository->listBusinesss();

        $this->setPageTitle('Deal', 'Create Deal');
        return view('business.deal.create', compact('categories','businesses'));
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

        $deal = $this->dealRepository->createDeal($params);

        if (!$deal) {
            return $this->responseRedirectBack('Error occurred while creating deal.', 'error', true, true);
        }
        return $this->responseRedirect('business.deal.index', 'Deal has been added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetDeal = $this->dealRepository->findDealById($id);
        $categories = $this->categoryRepository->listCategories();
        $businesses = $this->businessRepository->listBusinesss();

        $this->setPageTitle('Deal', 'Edit Deal : '.$targetDeal->title);
        return view('business.deal.edit', compact('targetDeal','categories','businesses'));
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

        $deal = $this->dealRepository->updateDeal($params);

        if (!$deal) {
            return $this->responseRedirectBack('Error occurred while updating deal.', 'error', true, true);
        }
        return $this->responseRedirectBack('Deal has been updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $deal = $this->dealRepository->deleteDeal($id);

        if (!$deal) {
            return $this->responseRedirectBack('Error occurred while deleting deal.', 'error', true, true);
        }
        return $this->responseRedirect('business.deal.index', 'Deal has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $deal = $this->dealRepository->updateDealStatus($params);

        if ($deal) {
            return response()->json(array('message'=>'Deal status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $deals = $this->dealRepository->detailsDeal($id);
        $deal = $deals[0];

        $this->setPageTitle('Deal', 'Deal Details : '.$deal->title);
        return view('business.deal.details', compact('deal'));
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
                            "expiry_date" => isset($importData[5]) ? $importData[5] : null,
                            "short_description" => isset($importData[6]) ? $importData[6] : null,
                            "description" => isset($importData[7]) ? $importData[7] : null,
                            "price" => isset($importData[8]) ? $importData[8] : null,
                            "promo_code" => isset($importData[9]) ? $importData[9] : null,
                            "how_to_redeem" => isset($importData[10]) ? $importData[10] : null,

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
        return redirect()->route('business.deal.index');
    }



    public function export()
    {
        return Excel::download(new DealExport, 'deal.xlsx');
    }
}
