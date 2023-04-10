<?php

namespace App\Services\Transaction;

use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Helpers\Global\Constant;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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

  public function handleCreateWithAvatar(Request $request)
  {
    DB::beginTransaction();
    try {
      // Jika ada gambar yang diupload
      if ($request->file('proof')) :
        $proof = Storage::putFile('public/images/proofs', $request->file('proof'));
      else :
        $proof = null;
      endif;

      /**
       * Tangkap input yang sudah tervalidasi.
       * Masukkan ke dalam variable dengan bentuk array dan simpan nama foto di database.
       */
      $validation = $request->validated();
      $validation['proof'] = $proof;
      $validation['upload_date'] = now()->format('Y-m-d');
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

  public function updateOrFail(int $id, Request $request)
  {
    DB::beginTransaction();
    try {
      // Jika Status Reject
      if ($request->status != Constant::REJECTED) :
        $reason = null;
      else :
        $reason = $request->reason;
      endif;

      $return = $this->mainRepository->updateOrFail($id, $request, $reason);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function handleDeleteWithImage(Transaction $transaction)
  {
    DB::beginTransaction();
    try {
      // Hapus foto lama.
      if ($transaction->proof) :
        Storage::delete($transaction->proof);
      endif;

      $return = $this->mainRepository->delete($transaction->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }
}
