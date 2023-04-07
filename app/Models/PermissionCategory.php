<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionCategory extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name'
  ];

  /**
   * Relation to permission model.
   */
  public function permissions()
  {
    return $this->hasMany(Permission::class, 'permission_category_id');
  }
}
