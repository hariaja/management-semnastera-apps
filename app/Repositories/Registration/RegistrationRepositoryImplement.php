<?php

namespace App\Repositories\Registration;

use App\Helpers\Global\Constant;
use App\Models\Registration;
use Illuminate\Support\Carbon;
use LaravelEasyRepository\Implementations\Eloquent;

class RegistrationRepositoryImplement extends Eloquent implements RegistrationRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(Registration $model)
  {
    $this->model = $model;
  }

  public function getOpenByDate()
  {
    return $this->model->all()->filter(function ($item) {
      if (Carbon::now()->between($item->date_start, $item->date_end)) {
        return $item;
      }
    })->where('status', Constant::OPEN);
  }
}
