<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Global\Constant;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Traits\RegisterUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
  use RegisterUsers;

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
    return Validator::make($data, [
      'first_title' => ['max:10'],
      'first_name' => ['required', 'string', 'max:50'],
      'last_name' => ['required', 'string', 'max:50'],
      'last_title' => ['max:10'],
      'gender' => ['required', 'string'],
      'institution' => ['required', 'string', 'max:50'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
      'roles' => ['required'],
      'address' => ['required', 'string'],
      'phone' => ['required', 'string', 'max:20', 'unique:users'],
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
    $registered = User::create([
      'name' => $data['first_name'] . ' ' . $data['last_name'],
      'first_title' => $data['first_title'] ? $data['first_title'] . '. ' : null,
      'last_title' => $data['last_title'],
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'gender' => $data['gender'],
      'institution' => $data['institution'],
      'email' => $data['email'],
      'phone' => $data['phone'],
      'address' => $data['address'],
      'password' => Hash::make($data['password']),
      'status' => Constant::ACTIVE,
    ]);

    $registered->assignRole($data['roles']);

    return $registered;
  }
}
