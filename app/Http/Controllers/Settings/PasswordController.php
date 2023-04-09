<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Traits\PasswordChange;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
  use PasswordChange;
}
