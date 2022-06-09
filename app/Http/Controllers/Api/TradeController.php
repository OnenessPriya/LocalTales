<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\TradeContract;
use App\Models\Business;
use Illuminate\Support\Facades\DB;
class TradeController extends Controller
{
    /**
     * @var TradeContract
     */
    protected $tradeRepository;


    /**
     * PageController constructor.
     * @param TradeContract $tradeRepository
     */
    public function __construct(TradeContract $tradeRepository){
        $this->tradeRepository = $tradeRepository;

    }

    /**
     * This method is for getting all trade question
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $categories = $this->tradeRepository->listTradeQuestion();

        return response()->json(['error'=>false, 'resp'=>'Trade Question data fetched successfully','data'=>$categories]);
    }



    /**
     * This method is for creating a loop
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){
        // $this->validate($request, [
        //     'user_id'      =>  'required',
        //     'content'     =>  'required',
        // ]);
        //   $params = $request->except('_token');
          $business_cat_id = DB::table('business_categories')->select('id')->where('title', 'LIKE', '%'.$request->category.'%')->first();
          $resp = Business::where('address', 'LIKE', '%'.$request->postcode.'%')->where('category_id', 'LIKE', '%'.$business_cat_id->id.'%')->get()->toArray();
        //   array_push($resp, $request->postcode);
        //   dd($resp);
            // dd($business_cat_id->id, $resp);
           $trade = $this->tradeRepository->createTradeQuestion($resp, $request);

           return response()->json(['error'=>false, 'resp'=>'Trade data created successfully','data'=>$trade]);

        // return response()->json(compact('loop'));

    }



    /**
     * This method is for getting user's loops
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function category(){
        $categories = $this->tradeRepository->getCategories();

        return response()->json(['error'=>false, 'resp'=>'Trade Question Category data fetched successfully','data'=>$categories]);
    }


}
