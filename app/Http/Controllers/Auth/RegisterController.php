<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'userType' => ['required'],
            'tel_no' => ['string'],
            'mob_no' => ['string'],
            'address' => ['string'],
            


        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        //     // 'userType' => $data['userType'],
        //     'tel_no' => $data['tel_np'],
        //     'mob_no' => $data['mob_no'],
        //     'address' => $data['address'],
        //     'status' => 'Pending',
        //     'userType' => 5,
        // ]);
        $statement = DB::select("SHOW TABLE STATUS LIKE 'users'");
        $userID = $statement[0]->Auto_increment;
        
        Session::put('userId', $userID);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // 'userType' => $data['userType'],
            'tel_no' => $data['tel_np'],
            'mob_no' => $data['mob_no'],
            'address' => $data['address'],
            'status' => 'Pending',
            'userType' => 5,
        ]);

        return redirect('/bookevent')->with('user', $user)->with('userId', $userID);
    }
}
