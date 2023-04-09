<?php

namespace App\Services\Transaction;

use Exception;
use InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use App\Repositories\Transaction\TransactionRepository;

class TransactionServiceImplement extends Service implements TransactionService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(TransactionRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function orderByUserId()
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->orderByUserId();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }
}
