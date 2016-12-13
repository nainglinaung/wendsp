<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Contracts\Auth\Authenticatable;

use App\admin as admin_model;
use App\Http\Requests\admin as admin_request;
use DB;
use Auth as auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

        public function __construct()
    {
        //$this->middleware('guest', ['except' => 'logout']);
    }
    
    protected function create(array $data)
    {
        return admin::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function login_access(admin_request $request,admin_model $model)
    {

        $admin_info=$request->only('username','password');



        if(Auth::attempt($admin_info))
        {
            $user=Auth::user();
            Auth::login($user,true);
            return redirect('/admin/pos/pos_panel');

        }
        else
        {
            return redirect('/admin/login');
        }

    }
    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }


}
