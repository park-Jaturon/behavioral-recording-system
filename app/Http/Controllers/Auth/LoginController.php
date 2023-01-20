<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request,[
            'usersname' => 'required',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('users_name' => $input['usersname'], 'password' => $input['password'])))
        {
            if (auth()->user()->rank == 'admin') {
               return redirect()->route('admindashboard')->withSuccess('Admin');
            } elseif(auth()->user()->rank == 'teacher'){
                return redirect()->route('teacherhome')->withSuccess('Teacher');
            }
            else {
                return redirect()->route('home');
            }
           
            
        }else{
            return redirect()->route('login')
            ->withErrors([
            'username' => 'Please login to access the dashboard.',
        ])->onlyInput('username');
        }
    }
}
