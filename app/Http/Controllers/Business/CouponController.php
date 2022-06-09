<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\CouponContract;
use App\Http\Controllers\BaseController;
use App\Models\Coupon;
class CouponController extends BaseController
{
    /**
     * @var CouponContract
     */
    protected $CouponRepository;


    /**
     * CouponController constructor.
     * @param CouponContract $CouponRepository
     *
     */
    public function __construct(CouponContract $CouponRepository)
    {
        $this->CouponRepository = $CouponRepository;

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index(Request $request)
    {


        if (!empty($request->term)) {
            // dd($request->term);
             $coupon = $this->CouponRepository->getSearchCoupons($request->term);

            // dd($categories);
         } else {
        $coupon = $this->CouponRepository->listCoupon();
         }
        $this->setPageTitle('Coupon', 'List of all Coupon');
        return view('business.coupon.index', compact('coupon'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {


        $this->setPageTitle('Coupon', 'Create Coupon');
        return view('business.coupon.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "coupon_code" => "required|string|max:255",
            "type" => "required|string",
            "amount" => "required",
            "max_time_of_use" => "required|integer",
            "max_time_one_can_use" => "required|integer",
            "start_date" => "required",
            "end_date" => "required",
        ]);

        $params = $request->except('_token');
        $storeData = $this->CouponRepository->createCoupon($params);

        if ($storeData) {
            return redirect()->route('business.market-coupon.index');
        } else {
            return redirect()->route('business.market-coupon.create')->withInput($request->all());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {


        $this->setPageTitle('Coupon', 'Edit Coupon : ');
        return view('business.coupon.detail');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $request->validate([
            "name" => "required|string|max:255",
            "coupon_code" => "required|string|max:255",
            "type" => "required|string",
            "amount" => "required",
            "max_time_of_use" => "required|integer",
            "max_time_one_can_use" => "required|integer",
            "start_date" => "required",
            "end_date" => "required",
        ]);

        $params = $request->except('_token');
        $storeData = $this->CouponRepository->updateCoupon($id, $params);

        if ($storeData) {
            return redirect()->route('business.market-coupon.index');
        } else {
            return redirect()->route('business.market-coupon.create')->withInput($request->all());
        }
    }
    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $coupon = $this->CouponRepository->deleteCoupon($id);

        if (!$coupon) {
            return $this->responseRedirectBack('Error occurred while deleting Coupon.', 'error', true, true);
        }
        return $this->responseRedirect('business.market-coupon.index', 'Coupon has been deleted successfully' ,'success',false, false);
    }



    public function status(Request $request, $id)
    {
        $storeData = $this->CouponRepository->toggle($id);

        if ($storeData) {
            return redirect()->route('business.market-coupon.index');
        } else {
            return redirect()->route('business.market-coupon.create')->withInput($request->all());
        }
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id)
    {
        $events = $this->CouponRepository->detailsCoupon($id);
        $coupon = $events[0];
        $usage = $this->CouponRepository->usageById($id);
        $this->setPageTitle('Coupon', 'Coupon Details : '.$coupon->title);
        return view('business.coupon.detail', compact('coupon','usage'));
    }
}
