<?php

namespace App\Services\Transaction;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface TransactionService extends BaseService
{
  public function orderByUserId();
  public function handleCreateWithAvatar(Request $request);
  public function updateOrFail(int $id, Request $request);
}
