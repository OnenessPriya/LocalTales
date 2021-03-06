<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Contracts\AdvertisementContract;
// use App\Contracts\CategoryContract;
 use App\Contracts\BusinessContract;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Auth;

class AdvertisementController extends BaseController
{
    /**
     * @var AdvertisementContract
     */
    protected $advertisementRepository;

    /**
     * NotificationController constructor.
     * @param AdvertisementContract $advertisementRepository
     */
    public function __construct(AdvertisementContract $advertisementRepository,BusinessContract $businessRepository)
    {
        $this->advertisementRepository = $advertisementRepository;
        $this->businessRepository = $businessRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function index()
    {
        $data = $this->advertisementRepository->findAdvertisementByBusiness(Auth::user()->id);

        $this->setPageTitle('Advertisement', 'List of all advertisements');
        return view('business.advertisement.index', compact('data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        // $categories = $this->categoryRepository->listCategories();
        // $businesses = $this->businessRepository->listBusinesss();

        $this->setPageTitle('Advertisement', 'Create Advertisement');
        return view('business.advertisement.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'description' => 'nullable',
            'page' => 'required',
            'slot_id' => 'required',
            'redirect_link' => 'required',
            'target_postcode' => 'required',
            'target_city' => 'required',
            'target_state' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png|max:100000',
        ]);

        $params = $request->except('_token');

        $advertisement = $this->advertisementRepository->createAdvertisement($params);

        if (!$advertisement) {
            return $this->responseRedirectBack('Error occurred while creating advertisement.', 'error', true, true);
        }
        return $this->responseRedirect('business.advertisement.index', 'Advertisement has been added successfully' ,'success', false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetAd = $this->advertisementRepository->findAdvertisementById($id);

        $this->setPageTitle('Advertisement', 'Edit Advertisement : '.$targetAd->title);
        return view('business.advertisement.edit', compact('targetAd'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'title' => 'required',
            'description' => 'nullable',
            'page' => 'required',
            'slot_id' => 'required',
            'redirect_link' => 'required',
            'target_postcode' => 'required',
            'target_city' => 'required',
            'target_state' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:100000',
        ]);

        $params = $request->except('_token');

        $advertisement = $this->advertisementRepository->updateAdvertisement($params);

        if (!$advertisement) {
            return $this->responseRedirectBack('Error occurred while updating Advertisement.', 'error', true, true);
        }
        return $this->responseRedirectBack('Advertisement has been updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $advertisement = $this->advertisementRepository->deleteAdvertisement($id);

        if (!$advertisement) {
            return $this->responseRedirectBack('Error occurred while deleting Advertisement.', 'error', true, true);
        }
        return $this->responseRedirect('business.advertisement.index', 'Advertisement has been deleted successfully' ,'success',false, false);
    }

    public function report(Request $request)
    {

        $businessId = (isset($request->business_id) && $request->business_id!='')?$request->business_id:'';
        $start_date = (isset($request->start_date) && $request->start_date!='')?$request->start_date:'';
        $end_date = (isset($request->end_date) && $request->end_date!='')?$request->end_date:'';
        $keyword = (isset($request->keyword) && $request->keyword!='')?$request->keyword:'';

        $data = $this->advertisementRepository->searchAdvertisementData($businessId,$start_date,$end_date,$keyword);
        $businesses = $this->businessRepository->listBusinesss();

        $this->setPageTitle('Advertisement Report', 'List of all advertisements');
        return view('business.advertisement.report', compact('data','businesses'));
    }


     /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userview($id)
    {
        $user_id = Auth::user()->id;
        $ads = $this->advertisementRepository->userview($id);
       // dd($ads);

        $this->setPageTitle('Advertisement Report', 'List of all advertisements');
        return view('business.advertisement.user-view', compact('ads'));
    }
}
