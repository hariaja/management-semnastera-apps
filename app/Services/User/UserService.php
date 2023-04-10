<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface UserService extends BaseService
{
  public function orderByName();
  public function changeStatus(int $id);
  public function handleCreateWithAvatar(Request $request);
  public function handleUpdateWithAvatar(User $user, Request $request);
  public function handleDeleteWithAvatar(User $user);
}
