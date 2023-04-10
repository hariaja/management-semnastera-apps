<?php

namespace App\Services\Journal;

use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Helpers\Global\Constant;
use App\Models\Journal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use LaravelEasyRepository\Service;
use App\Repositories\Journal\JournalRepository;

class JournalServiceImplement extends Service implements JournalService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(JournalRepository $mainRepository)
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

  public function uploadWithFile(Request $request)
  {
    DB::beginTransaction();
    try {

      // Manajamen file
      if ($request->file('file')) :
        $file = Storage::putFile('public/pdf', $request->file('file'));
      endif;

      $validation = $request->validated();
      $validation['file'] = $file;
      $validation['category'] = strtoupper($request->category);
      $validation['upload_year'] = $request->upload_year;
      $validation['user_id'] = me()->id;

      $return = $this->mainRepository->create($validation);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function deleteWithFile(Journal $journal)
  {
    DB::beginTransaction();
    try {

      // Manajamen file
      if ($journal->file) :
        Storage::delete($journal->file);
      endif;

      $return = $this->mainRepository->delete($journal->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }
}
