<?php

namespace App\Traits;

use App\Models\Role;
use App\Helpers\Global\Constant;
use App\Services\Role\RoleService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RedirectsUsers;

trait RegisterUsers
{
  use RedirectsUsers;

  /**
   * Show the application registration form.
   *
   * @return \Illuminate\View\View
   */
  public function showRegistrationForm()
  {
    $roles = Role::select('*')->whereNotIn('name', [
      Constant::ADMIN,
      Constant::REVIEWER,
    ])->orderBy('name', 'ASC')->get();

    return view('auth.register', compact('roles'));
  }

  /**
   * Handle a registration request for the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
   */
  public function register(Request $request)
  {
    $this->validator($request->all())->validate();

    event(new Registered($user = $this->create($request->all())));

    $this->guard()->login($user);

    if ($response = $this->registered($request, $user)) {
      return $response;
    }

    return $request->wantsJson() ? new JsonResponse([], 201) : redirect($this->redirectPath());
  }

  /**
   * Get the guard to be used during registration.
   *
   * @return \Illuminate\Contracts\Auth\StatefulGuard
   */
  protected function guard()
  {
    return Auth::guard();
  }

  /**
   * The user has been registered.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  mixed  $user
   * @return mixed
   */
  protected function registered(Request $request, $user)
  {
    //
  }
}
