<?php

namespace App\Http\Controllers\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Models\Review;
use App\Models\Order;
use App\Models\LocalTradeQueryRequest;
use Illuminate\Support\Facades\Validator;
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect business module after login.
     *
     * @var string
     */
    protected $redirectTo = '/business';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:business')->except('logout');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('business.auth.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        $remember_me = $request->has('remember') ? true : false;

        if (Auth::guard('business')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $remember_me)) {
            // dd('here');
            return redirect()->intended(route('business.dashboard'));
        }

        return back()->withInput($request->only('email', 'remember'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function logout(Request $request)
    {
        Auth::guard('business')->logout();
        $request->session()->invalidate();
        return redirect()->route('business.login');
    }




    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editUserProfile(){
        $this->setPageTitle('Edit Profile', 'Edit Profile');
        return view('business.auth.edit_profile' );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $userId = Auth::user()->id;
        $params = $request->except('_token');
        $params['id'] = $userId;

        $user = $this->userRepository->updateUser($params);

        if (!$user) {
            return $this->responseRedirectBack('Error occurred while updating profile.', 'error', true, true);
        }
        return $this->responseRedirect('site.dashboard.editProfile', 'You have successfully updated your profile' ,'success',false, false);
    }

    public function notificationList(){
        $notifications = $this->notificationRepository->listNotifications();

        $this->setPageTitle('Notification List', 'Notification List');
        return view('business.auth.notifications' , compact('notifications'));
    }

/**
     * This method is for admin dashboard
     *
     */
    public function home(Request $request)
    {
        // $data = $userRepository->listAll();
        // dd($data->count());
        dd('here');
        $data = (object)[];
        $data->review = Review::count();

        $data->localtrade = LocalTradeQueryRequest::count();
        $data->orders = Order::latest('id')->limit(5)->get();
        return view('business.dashboard.index', compact('data'));
    }


}
