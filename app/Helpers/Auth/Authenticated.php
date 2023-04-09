<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;

function me(): Authenticatable
{
  return Auth::user();
}

function isRoleName()
{
  return me()->roles->implode('name');
}

function isRoleId()
{
  return me()->roles->implode('uuid');
}
