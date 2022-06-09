<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\BusinessContract;
use App\Contracts\CategoryContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DirectoryExport;
class BusinessController extends BaseController
{
    /**
     * @var BusinessContract
     */
    protected $businessRepository;
    /**
     * @var CategoryContract
     */
    protected $categoryRepository;


    /**
     * BusinessController constructor.
     * @param BusinessContract $businessRepository
     * @param CategoryContract $categoryRepository
     */
    public function __construct(BusinessContract $businessRepository, CategoryContract $categoryRepository)
    {
        $this->businessRepository = $businessRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        $categoryId = (isset($request->category_id) && $request->category_id!='')?$request->category_id:'';
        $keyword = (isset($request->keyword) && $request->keyword!='')?$request->keyword:'';
        $pinCode = (isset($request->address) && $request->address!='')?$request->address:'';
        $establish_year = (isset($request->establish_year) && $request->establish_year!='')?$request->establish_year:'';
        $opening_hour = (isset($request->opening_hour) && $request->opening_hour!='')?$request->opening_hour:'';

        //$suburb = (isset($request->suburb_id) && $request->suburb_id!='')?$request->suburb_id:'';


        //$deals = $this->dealRepository->getDealsByPinCode($pinCode);
        $businesses = $this->businessRepository->searchDirectoryData($categoryId,$keyword,$pinCode,$establish_year,$opening_hour);

        $categories = $this->businessRepository->getDirectorycategories();
        $this->setPageTitle('Business', 'List of all businesses');
        return view('admin.business.index', compact('businesses','categories'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->categoryRepository->listCategories();

        $this->setPageTitle('Business', 'Create Business');
        return view('admin.business.create',compact('categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'email'     =>  'required|max:1000',
        ]);

        $params = $request->except('_token');

        $business = $this->businessRepository->createBusiness($params);

        if (!$business) {
            return $this->responseRedirectBack('Error occurred while creating business.', 'error', true, true);
        }
        return $this->responseRedirect('admin.business.index', 'Business added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $categories = $this->categoryRepository->listCategories();
        $targetBusiness = $this->businessRepository->findBusinessById($id);

        $this->setPageTitle('Business', 'Edit Business : '.$targetBusiness->title);
        return view('admin.business.edit', compact('targetBusiness','categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
        ]);

        $params = $request->except('_token');

        $business = $this->businessRepository->updateBusiness($params);

        if (!$business) {
            return $this->responseRedirectBack('Error occurred while updating business.', 'error', true, true);
        }
        return $this->responseRedirectBack('Business updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $business = $this->businessRepository->deleteBusiness($id);

        if (!$business) {
            return $this->responseRedirectBack('Error occurred while deleting business.', 'error', true, true);
        }
        return $this->responseRedirect('admin.business.index', 'Business deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request){

        $params = $request->except('_token');

        $business = $this->businessRepository->updateBusinessStatus($params);

        if ($business) {
            return response()->json(array('message'=>'Business status successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $businesses = $this->businessRepository->detailsBusiness($id);
        $business = $businesses[0];

        $this->setPageTitle('Business', 'Business Details : '.$business->title);
        return view('admin.business.details', compact('business'));
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
                    $location = 'admin/uploads/csv';
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
                        // $storeData = 0;
                        // if(isset($importData[5]) == "Carry In") $storeData = 1;

                        // ALTER TABLE `directories` CHANGE `category_id` `category_id` VARCHAR(255) NULL DEFAULT NULL;
                        // make all fields null

                        $commaSeperatedCats = '';
                        foreach(explode(',', $importData[15]) as $cateKey => $catVal) {
                            $catExistCheck = DirectoryCategory::where('title', $catVal)->first();
                            if ($catExistCheck) {
                                $insertDirCatId = $catExistCheck->id;
                                $commaSeperatedCats .= $insertDirCatId.',';
                            } else {
                                $dirCat = new DirectoryCategory();
                                $dirCat->title = $catVal;
                                $dirCat->slug = null;
                                $dirCat->save();
                                $insertDirCatId = $dirCat->id;

                                $commaSeperatedCats .= $insertDirCatId.',';
                            }
                        }
                        // dd($commaSeperatedCats);

                        $insertData = array(
                            "name" => isset($importData[0]) ? $importData[0] : null,
                            "address" => isset($importData[1]) ? $importData[1] : null,
                            "mobile" => isset($importData[2]) ? $importData[2] : null,
                            "website" => isset($importData[3]) ? $importData[3] : null,
                            "email" => isset($importData[4]) ? $importData[4] : null,
                            "establish_year" => isset($importData[5]) ? $importData[5] : null,
                            "ABN" => isset($importData[6]) ? $importData[6] : null,
                            "monday" => isset($importData[7]) ? $importData[7] : null,
                            "tuesday" => isset($importData[8]) ? $importData[8] : null,
                            "wednesday" => isset($importData[9]) ? $importData[9] : null,
                            "thursday" => isset($importData[10]) ? $importData[10] : null,
                            "friday" => isset($importData[11]) ? $importData[11] : null,

                            "saturday" => isset($importData[12]) ? $importData[12] : null,
                            "sunday" => isset($importData[13]) ? $importData[13] : null,
                            "public_holiday" => isset($importData[14]) ? $importData[14] : null,
                            "category_id" => isset($commaSeperatedCats) ? $commaSeperatedCats : null,
                            "category_tree" => isset($importData[16]) ? $importData[16] : null,
                            "url" => isset($importData[17]) ? $importData[17] : null,

                            // "password" => isset($importData[2]) ? $importData[2] : null,
                            // "mobile" => isset($importData[3]) ? $importData[3] : null,
                            // "address" => isset($importData[4]) ? $importData[4] : null,
                            // "pin" => isset($importData[5]) ? $importData[5] : null,
                            // "lat" => isset($importData[6]) ? $importData[6] : null,
                            // "lon" => isset($importData[7]) ? $importData[7] : null,
                            // "description" => isset($importData[8]) ? $importData[8] : null,
                            // "service_description" => isset($importData[9]) ? $importData[9] : null,
                            //"opening_hour" => isset($importData[10]) ? $importData[10] : null,

                            // "facebook_link" => isset($importData[12]) ? $importData[12] : null,

                            // "twitter_link" => isset($importData[13]) ? $importData[13] : null,
                            // "instagram_link" => isset($importData[14]) ? $importData[14] : null,




                            // "status" => isset($importData[27]) ? $importData[27] : null,
                        );
                        // echo '<pre>';print_r($insertData);exit();
                        Directory::insertData($insertData);
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
        return redirect()->route('admin.business.index');
    }

    public function export()
    {
        return Excel::download(new DirectoryExport, 'directory.xlsx');
    }
}
