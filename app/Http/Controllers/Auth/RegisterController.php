<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('isadmin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
        return Validator::make($data, [
            'name' => ['required', 'string','min:3', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'inlineRadioOptions' => ['required'],
            'rankid' => ['required'],
            
        ],[
            'name.required' => 'โปรดระบุ IDName',
            'name.min' => 'ข้อมูลไม่ถูกต้อง IDName ต้องมีอย่างน้อย 3 ตัว', 
            'password' => 'ข้อมูลไม่ถูกต้อง password ต้องมีอย่างน้อย 9 ตัว',
            'inlineRadioOptions.required' => 'กรุณาเลือกสิทธิผู้ใช้งาน',
            'rankid.required' => 'กรุณาเลือกชื่อผู้ใช้งาน',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
      
        return User::create([
            'users_name' => $data['name'],
            'password' => Hash::make($data['password']),
            'rank_id' => $data['rankid'],
            'rank' => $data['inlineRadioOptions']
        ]);
    }
}
