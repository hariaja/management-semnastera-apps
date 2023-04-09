<?php

namespace App\Models;

use App\Traits\Uuid;
use Spatie\Permission\Models\Role as ModelRole;

class Role extends ModelRole
{
  use Uuid;

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }
}
