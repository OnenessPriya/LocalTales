<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\MarketProductContract;
use App\Contracts\MarketCategoryContract;
use App\Contracts\MarketSubCategoryContract;
use App\Contracts\BusinessContract;
use App\Http\Controllers\BaseController;
class ItemController extends BaseController
{
    /**
     * @var MarketProductContract
     */
    protected $MarketProductRepository;
    /**
     * @var MarketCategoryContract
     */
    protected $MarketCategoryRepository;
     /**
     * @var MarketSubCategoryContract
     */
    protected $MarketSubCategoryRepository;
    /**
     * @var BusinessContract
     */
    protected $businessRepository;


    /**
     * ProductController constructor.
     * @param ProductContract $ProductRepository
     */
    public function __construct(MarketProductContract $MarketProductRepository,MarketCategoryContract $MarketCategoryRepository,MarketSubCategoryContract $MarketSubCategoryRepository,BusinessContract $businessRepository)
    {
        $this->MarketProductRepository = $MarketProductRepository;
        $this->MarketCategoryRepository = $MarketCategoryRepository;
        $this->MarketSubCategoryRepository = $MarketSubCategoryRepository;
        $this->businessRepository = $businessRepository;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $product = $this->MarketProductRepository->listProduct();

        $this->setPageTitle('Product', 'List of all Product');
        return view('admin.product.index', compact('product'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->MarketCategoryRepository->listCategories();
        $subcategories = $this->MarketSubCategoryRepository->listSubCategories();
        $businesses = $this->businessRepository->listBusinesss();

        $this->setPageTitle('Product', 'Create Product');
        return view('business.product.create', compact('categories','subcategories','businesses'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'image'     =>  'required|mimes:jpg,jpeg,png|max:1000',
        ]);

        $params = $request->except('_token');

        $product = $this->MarketProductRepository->createProduct($params);
       // dd($product);
        if (!$product) {
            return $this->responseRedirectBack('Error occurred while creating Product.', 'error', true, true);
        }
        return $this->responseRedirect('business.product.index', 'Product has been added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $product = $this->MarketProductRepository->findProductById($id);
        $categories = $this->MarketCategoryRepository->listCategories();
        $subcategories = $this->MarketSubCategoryRepository->listSubCategories();
        $businesses = $this->businessRepository->listBusinesss();

        $this->setPageTitle('Product', 'Edit Product : '.$product->title);
        return view('business.product.edit', compact('product','categories','subcategories','businesses'));
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

        $product = $this->MarketProductRepository->updateProduct($params);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while updating Product.', 'error', true, true);
        }
        return $this->responseRedirectBack('Product has been updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $product = $this->MarketProductRepository->deleteProduct($id);

        if (!$product) {
            return $this->responseRedirectBack('Error occurred while deleting Product.', 'error', true, true);
        }
        return $this->responseRedirect('business.product.index', 'Product has been deleted successfully' ,'success',false, false);
    }

    // /**
    //  * @param Request $request
    //  * @return \Illuminate\Http\RedirectResponse
    //  * @throws \Illuminate\Validation\ValidationException
    //  */
    // public function updateStatus(Request $request){

    //     $params = $request->except('_token');

    //     $product = $this->ProductRepository->updateDealStatus($params);

    //     if ($product) {
    //         return response()->json(array('message'=>'Product status has been successfully updated'));
    //     }
    // }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $deals = $this->MarketProductRepository->detailsProduct($id);
        $product = $deals[0];

        $this->setPageTitle('Product', 'Product Details : '.$product->name);
        return view('business.product.details', compact('product'));
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
                            "name" => isset($importData[0]) ? $importData[0] : null,
                            "short_desc" => isset($importData[1]) ? $importData[1] : null,
                            "desc" => isset($importData[2]) ? $importData[2] : null,
                            "price" => isset($importData[3]) ? $importData[3] : null,
                            "offer_price" => isset($importData[4]) ? $importData[4] : null,
                            "slug" => isset($importData[5]) ? $importData[5] : null,
                            "meta_title" => isset($importData[6]) ? $importData[6] : null,
                            "meta_desc" => isset($importData[7]) ? $importData[7] : null,
                            "meta_keyword" => isset($importData[8]) ? $importData[8] : null,
                            "pincode" => isset($importData[9]) ? $importData[9] : null,

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
        return redirect()->route('business.market-product.index');
    }

    public function export()
    {
        return Excel::download(new ItemExport, 'item.xlsx');
    }
}
