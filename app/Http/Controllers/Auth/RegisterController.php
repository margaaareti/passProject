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

        $messages = [
            'itmo_email' => "Для подачи заявок следует использовать только корпоративную почту университета ИТМО"
        ];

        return Validator::make($data, [
            'last_name' => ['required', 'regex:/^[а-яА-ЯёЁ\s]+$/u', 'max:50'],
            'name' => ['required', 'regex:/^[а-яА-ЯёЁ\s]+$/u', 'max:50'],
            'patronymic' => ['regex:/^[а-яА-ЯёЁ\s]+$/u', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:150', 'unique:users', 'itmo_email'],
            'department' => ['required', 'string'],
            'isu_number' => ['required', 'string', 'digits:6','unique:users'],
            'phone_number' => ['required', 'string', 'regex:/^8-[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}$/','starts_with:8', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], $messages);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $newUser = User::create([
            'last_name' => $data['last_name'],
            'name' => $data['name'],
            'patronymic' => $data['patronymic'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'department' => $data['department'],
            'isu_number' => $data['isu_number'],
            'phone_number' => $data['phone_number'],
        ]);

        $newUser->assignRole('user');

        return $newUser;

    }

}
