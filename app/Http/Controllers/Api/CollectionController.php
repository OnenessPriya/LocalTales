<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\CollectionContract;

use App\Http\Controllers\BaseController;
use Auth;
class CollectionController extends Controller
{
     /**
     * @var CollectionContract
     */
    protected $collectionRepository;


    /**
     * CollectionController constructor.
     * @param CollectionContract $collectionRepository
     */
    public function __construct(CollectionContract $collectionRepository)
    {
        $this->collectionRepository = $collectionRepository;
    }

    /**
     * This method is for getting collection 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $collection = $this->collectionRepository->listCollection();
        if ($collection) {
            $storesCustom = [];
            foreach($collection as $storeKey => $storeValue) {
                $storesCustom[] = [
                    'id' => $storeValue->id,
                    'Collection Title'=>$storeValue->title,
                    'Slug' => $storeValue->slug,
                    'Short Description'=>$storeValue->short_description,
                    'Bottom Content'=>$storeValue->bottom_content,
                    'Description'=>$storeValue->description,
                    'Pincode'=>$storeValue->pin_code,
                    'Suburb id'=>$storeValue->suburb_id,
                    'Address'=>$storeValue->address,
                    'Meta title'=>$storeValue->meta_title,
                    'Meta key'=>$storeValue->meta_key,
                    'Meta Description'=>$storeValue->meta_description,
                    'Status'=>$storeValue->status,
                    'Rating'=>$storeValue->rating,
                    'Image' => env('APP_URL').'/'.asset($storeValue->image),

                ];
            }
        return response()->json(['error'=>false, 'resp'=>'Collection data fetched successfully','data'=>$storesCustom]);
    } else {
        return response()->json(['error' => true, 'resp' => 'Something happened']);
     }
    }

    /**
     * This method is for getting collection details
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function details($id){

        $collections = $this->collectionRepository->detailsCollection($id);
        $collection = $collections[0];
        $related_collection = $this->collectionRepository->getRelatedCollection($collection->address,$id);
        return response()->json(compact('collection','related_collection'));

    }




    /**
     * This method is to get collection wise directory data
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function collectionwiseDirectory($id){

       // $collectionId = $request->route('id');
        $collection = $this->collectionRepository->directorywisecollection($id);

        if ($collection) {
            $storesCustom = [];
            foreach($collection as $storeKey => $storeValue) {
                $storesCustom[] = [
                    'id' => $storeValue->id,
                    'Collection Title'=>$storeValue->collection->title,
                    'Directory Id' => $storeValue->directory_id,
                    'Directory Name'=>$storeValue->directory->name,
                    'Email'=>$storeValue->directory->email,
                    'Contact'=>$storeValue->directory->mobile,
                    'Alternate Mobile'=>$storeValue->directory->alternate_mobile,
                    'email'=>$storeValue->directory->email,
                    'Address'=>$storeValue->directory->address,
                    'Category Id'=>$storeValue->directory->category_id,
                    'Establish Year'=>$storeValue->directory->establish_year,
                    'ABN'=>$storeValue->directory->ABN,
                    'Monday'=>$storeValue->directory->Monday,
                    'Tuesday'=>$storeValue->directory->tuesday,
                    'wednesday'=>$storeValue->directory->wednesday,
                    'Thursday'=>$storeValue->directory->thursday,
                    'Friday'=>$storeValue->directory->friday,
                    'Saturday'=>$storeValue->directory->saturday,
                    'Sunday'=>$storeValue->directory->sunday,
                    'Public Holiday'=>$storeValue->directory->public_holiday,
                    'Category Tree'=>$storeValue->directory->category_tree,
                    'Description'=>$storeValue->directory->description,
                    'Service Description'=>$storeValue->directory->service_description,
                    'Trading name'=>$storeValue->directory->trading_name,
                    'Primary name'=>$storeValue->directory->primary_name,
                    'Primary email'=>$storeValue->directory->primary_email,
                    'Primary phone'=>$storeValue->directory->primary_phone,
                    'Opening hour'=>$storeValue->directory->opening_hour,
                    'Website'=>$storeValue->directory->website,
                    'Facebook_link'=>$storeValue->directory->facebook_link,
                    'Twitter_link'=>$storeValue->directory->twitter_link,
                    'Instagram_link'=>$storeValue->directory->instagram_link,
                    'Url'=>$storeValue->directory->url,
                    'Image' => env('APP_URL').'/'.asset($storeValue->directory->image),
                    'Banner Image' => env('APP_URL').'/'.asset($storeValue->directory->banner_image),
                    'Image 2' => env('APP_URL').'/'.asset($storeValue->directory->image2),
                ];
            }
        return response()->json(['error'=>false, 'resp'=>'Collection wise Directory data fetched successfully','data'=>$storesCustom]);
     } else {
        return response()->json(['error' => true, 'resp' => 'Something happened']);
     }
    }







}
