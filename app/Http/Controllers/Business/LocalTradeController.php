<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\TradeContract;
// use App\Contracts\CategoryContract;
 use App\Contracts\BusinessContract;
 use App\Http\Controllers\BaseController;
use App\Models\LocalTradeQueryRequest;

class LocalTradeController extends BaseController
{
    /**
     * @var TradeContract
     */
    protected $TradeRepository;

    /**
     * LocalTradeController constructor.
     * @param TradeContract $TradeRepository
     */
    public function __construct(TradeContract $TradeRepository,BusinessContract $businessRepository)
    {
        $this->TradeRepository = $TradeRepository;
        $this->businessRepository = $businessRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {
        $cat =LocalTradeQueryRequest::paginate(5);
        if (!empty($request->term)) {
            // dd($request->term);
             $data = $this->TradeRepository->getSearchTrade($request->term);

            // dd($categories);
         } else {
        $data = $this->TradeRepository->getLocalTradeRequest();
         }
        $this->setPageTitle('Local Trade Request', 'List of all Enquiries');
        return view('business.local-trade.index', compact('data','cat'));
    }

}
