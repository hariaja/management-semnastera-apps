<?php

namespace App\Services\User;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserServiceImplement extends Service implements UserService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(UserRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function orderByName()
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->orderByName();
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
      if ($request->file('avatar')) :
        $avatar = Storage::putFile('public/images/users', $request->file('avatar'));
      else :
        $avatar = null;
      endif;

      /**
       * Tangkap input yang sudah tervalidasi.
       * Masukkan ke dalam variable dengan bentuk array dan simpan nama foto di database.
       */
      $validation = $request->validated();
      $validation['avatar'] = $avatar;
      $validation['name'] = $request->first_name . ' ' . $request->last_name;
      $validation['institution'] = strtoupper($request->institution);
      $validation['password'] = Hash::make('password');

      $return = $this->mainRepository->create($validation);
      $return->assignRole($request->roles);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function handleUpdateWithAvatar(User $user, Request $request)
  {
    DB::beginTransaction();
    try {
      // Jika ada gambar yang diupload
      if ($request->file('avatar')) :
        // Hapus foto lama
        if ($request->old_avatar) :
          Storage::delete($user->avatar);
        endif;
        $avatar = Storage::putFile('public/images/users', $request->file('avatar'));
      else :
        $avatar = $request->old_avatar;
      endif;

      /**
       * Tangkap input yang sudah tervalidasi.
       * Masukkan ke dalam variable dengan bentuk array dan simpan nama foto di database.
       */
      $validation = $request->validated();
      $validation['avatar'] = $avatar;
      $validation['name'] = $request->first_name . ' ' . $request->last_name;
      $validation['institution'] = strtoupper($request->institution);

      $return = $this->mainRepository->update($user->id, $validation);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function handleDeleteWithAvatar(User $user)
  {
    DB::beginTransaction();
    try {
      // Hapus foto lama.
      if ($user->avatar) :
        Storage::delete($user->avatar);
      endif;

      $return = $this->mainRepository->delete($user->id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }

  public function changeStatus(int $id)
  {
    DB::beginTransaction();
    try {
      $return = $this->mainRepository->changeStatus($id);
    } catch (Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
    DB::commit();
    return $return;
  }
}
