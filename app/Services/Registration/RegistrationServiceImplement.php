<?php

namespace App\Services\Registration;

use Exception;
use InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use LaravelEasyRepository\Service;
use App\Repositories\Registration\RegistrationRepository;

class RegistrationServiceImplement extends Service implements RegistrationService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(RegistrationRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function getOpenByDate()
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->getOpenByDate();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }
}
