<?php

namespace App\Services\Role;

use Exception;
use InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use App\Repositories\Role\RoleRepository;

class RoleServiceImplement extends Service implements RoleService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(RoleRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function firstOrCreate(Request $request)
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->firstOrCreate($request);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function updateOrFail(int $id, Request $request)
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->updateOrFail($id, $request);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function roleHasPermissions(int $id)
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->roleHasPermissions($id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function roleWhereNotIn()
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->roleWhereNotIn();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function roleReviewer()
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->roleReviewer();
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }
}
