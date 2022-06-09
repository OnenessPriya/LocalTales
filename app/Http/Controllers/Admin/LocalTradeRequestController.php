<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\TradeContract;
use App\Models\LocalTradeQueryRequest;
use App\Http\Controllers\BaseController;
class LocalTradeRequestController extends BaseController
{
    /**
     * @var TradeContract
     */
    protected $TradeRepository;

    /**
     * LocalTradeController constructor.
     * @param TradeContract $TradeRepository
     */
    public function __construct(TradeContract $TradeRepository)
    {
        $this->TradeRepository = $TradeRepository;

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
        return view('admin.local-trade.index', compact('data','cat'));
    }

}
