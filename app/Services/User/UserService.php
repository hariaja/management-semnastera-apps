<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface UserService extends BaseService
{
  public function handleUpdateWithAvatar(User $user, Request $request);
  public function handleDeletWithAvatar(User $user);
}
