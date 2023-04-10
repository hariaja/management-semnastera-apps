<?php

namespace App\Repositories\Transaction;

use App\Models\Transaction;
use Illuminate\Http\Request;
use LaravelEasyRepository\Repository;

interface TransactionRepository extends Repository
{
  public function orderByUserId();
  public function updateOrFail(int $id, Request $request, $reason);
}
