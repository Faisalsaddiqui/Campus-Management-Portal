<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Inertia\Inertia;
use App\Traits\UserStudentTrait;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Composer\DependencyResolver\Transaction;
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
    protected $redirectTo = '/home';



    /**
     * 
     * Decides user dashboard based on role
     * 
     */
    protected function redirectTo()
    {

        return '/applicant/dashboard?status=registered';
    }

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

        //using the store user form request validator rules
        $request = new StoreUserRequest;
        return Validator::make($data, $request->rules());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $user = DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'father_name' => $data['father_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'gender' => $data['gender'],
                'phone' => $data['phone'],
                'cnic' => $data['cnic'],
                'date_of_birth' => $data['date_of_birth']
            ]);

            //We are assiging applicant role to standard signup form
            $user->assignRole('applicant');

            return $user;
        });

        return $user;
    }

    public function showRegistrationForm()
    {
        return Inertia::render('User/RegisterPage');
    }
}
