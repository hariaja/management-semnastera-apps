<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as ModelPermission;

class Permission extends ModelPermission
{
  use HasFactory;

  /**
   * Relation to permission category model.
   */
  public function permissionCategory()
  {
    return $this->belongsTo(PermissionCategory::class, 'permission_category_id');
  }
}
