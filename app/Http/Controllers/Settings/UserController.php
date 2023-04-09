<?php

namespace App\Http\Controllers\Settings;

use App\DataTables\Scopes\RolesFilter;
use App\DataTables\Scopes\StatusFilter;
use App\DataTables\Settings\UserDataTable;
use App\Helpers\Global\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UserRequest;
use App\Models\User;
use App\Services\Role\RoleService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected RoleService $roleService,
    protected UserService $userService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(UserDataTable $dataTable, Request $request)
  {
    return $dataTable->addScope(new StatusFilter($request))->addScope(new RolesFilter($request))->render('settings.users.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $roles = $this->roleService->roleWhereNotIn();
    return view('settings.users.create', compact('roles'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(UserRequest $request)
  {
    $this->userService->handleCreateWithAvatar($request);
    return redirect()->route('users.index')->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user)
  {
    if (me()->uuid === $user->uuid) :
      return view('settings.users.profile', compact('user'));
    else :
      return view('settings.users.show', compact('user'));
    endif;
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user)
  {
    if (me()->uuid === $user->uuid) :
      return redirect()->back()->with('error', trans('Mohon untuk mengubah data diri anda di halaman profile'));
    endif;

    $roles = $this->roleService->roleWhereNotIn();
    return view('settings.users.edit', compact('user', 'roles'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UserRequest $request, User $user)
  {
    $this->userService->handleUpdateWithAvatar($user, $request);
    return redirect()->route('users.index')->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user)
  {
    $this->userService->handleDeletWithAvatar($user);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }

  protected function checkIfAdmin(User $user, string $message = null)
  {
    if (isRoleName() !== $user->hasRole(Constant::ADMIN)) :
      return redirect()->back()->with('error', $message);
    endif;
  }

  protected function onwerUuid(User $user, string $message = null)
  {
    if (me()->uuid === $user->uuid) :
      return redirect()->back()->with('error', $message);
    endif;
  }
}
