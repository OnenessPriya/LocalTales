<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\BlogContract;
use App\Http\Controllers\BaseController;
use Auth;
class ArticleController extends Controller
{
    /**
     * @var BlogContract
     */
    protected $blogRepository;


    /**
     * ArticleController constructor.
     * @param BlogContract $blogRepository
     */
    public function __construct(BlogContract $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    /**
     * This method is for getting article 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $article = $this->blogRepository->listBlogs();

        if ($article) {
            $storesCustom = [];
            foreach($article as $storeKey => $storeValue) {
                $storesCustom[] = [
                    'id' => $storeValue->id,
                    'Article Title'=>$storeValue->title,
                    'Category Id' => $storeValue->category->id,
                    'Category Title' => $storeValue->category->title,
                    //'SubCategory Id' => $storeValue->subcategory->id,
                    //'SubCategory Title' => $storeValue->subcategory->title,
                    'Description'=>$storeValue->description,
                    'Pincode'=>$storeValue->pin_code,
                   // 'Suburb id'=>$storeValue->suburb_id,
                   // 'Suburb Title'=>$storeValue->suburb->name,
                    'Tag'=>$storeValue->tag,
                    'Meta title'=>$storeValue->meta_title,
                    'Meta key'=>$storeValue->meta_key,
                    'Meta Description'=>$storeValue->meta_description,
                    'Blog views'=>$storeValue->blog_views,
                    'Status'=>$storeValue->status,
                    'Rating'=>$storeValue->rating,
                    'Image' => env('APP_URL').'/'.asset($storeValue->image),
                    'Banner Image' => env('APP_URL').'/'.asset($storeValue->banner_image),
                    'Image 2' => env('APP_URL').'/'.asset($storeValue->image2),

                ];
            }
        return response()->json(['error'=>false, 'resp'=>'Article data fetched successfully','data'=>$storesCustom]);
    } else {
        return response()->json(['error' => true, 'resp' => 'Something happened']);
     }
    }

    /**
     * This method is for getting article details
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function details($id){

        $collections = $this->blogRepository->detailsBlog($id);
        $article = $collections[0];
        $related_article = $this->blogRepository->getRelatedArticle($article->pincode,$id);
        return response()->json(compact('article','related_article'));
    }



    /**
     * This method is to get article data
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Request $request){

        $pinCode = (isset($request->pincode) && $request->pincode!='')?$request->pincode:'';

        $keyword = (isset($request->keyword) && $request->keyword!='')?$request->keyword:'';
        $categoryId = (isset($request->category_id) && $request->category_id!='')?$request->category_id:'';
        $suburb = (isset($request->suburb_id) && $request->suburb_id!='')?$request->suburb_id:'';
        $blogs = $this->blogRepository->searchBlogsData($pinCode,$categoryId,$keyword,$suburb);
        return response()->json(compact('blogs'));
    }



}
