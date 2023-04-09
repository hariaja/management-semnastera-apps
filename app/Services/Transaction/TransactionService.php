<?php

namespace App\Services\Transaction;

use LaravelEasyRepository\BaseService;

interface TransactionService extends BaseService
{
  public function orderByUserId();
}
