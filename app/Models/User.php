<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Uuid;
use App\Helpers\Global\Constant;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, HasRoles, Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $guarded = ['id'];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * Get default avatar user.
   */
  public function getAvatar()
  {
    if (!$this->avatar) :
      return asset('assets/images/default.png');
    else :
      return Storage::url($this->avatar);
    endif;
  }

  /**
   * Get the user role name.
   *
   */
  public function isRoleName()
  {
    return $this->roles->implode('name');
  }

  /**
   * Get the user role id.
   *
   */
  public function isRoleId()
  {
    return $this->roles->implode('id');
  }

  public function scopeExcludeAdmin($query)
  {
    return $query->whereDoesntHave('roles', function ($q) {
      $q->where('name', Constant::ADMIN);
    });
  }

  /**
   * Get the user status account.
   *
   */
  public function isStatus()
  {
    if ($this->status == Constant::ACTIVE) :
      return '<span class="badge text-success">' . trans('session.users.active') . '</span>';
    else :
      return '<span class="badge text-danger">' . trans('session.users.inactive') . '</span>';
    endif;
  }

  /**
   * Get the user status verified email account.
   *
   */
  public function isVerified()
  {
    if ($this->hasVerifiedEmail()) :
      return '<span class="badge text-success">' . Constant::VERIFIED . '</span>';
    else :
      return '<span class="badge text-danger">' . Constant::UNVERIFIED . '</span>';
    endif;
  }

  /**
   * Scope a query to only include active users.
   */
  public function scopeActive($data)
  {
    return $data->where('status', Constant::ACTIVE);
  }

  public function getActive(): Collection
  {
    return $this->active()->get();
  }

  /**
   * Scope a query to only include inactive users.
   */
  public function scopeInactive($data)
  {
    return $data->where('status', Constant::INACTIVE);
  }

  public function getInactive(): Collection
  {
    return $this->inactive()->get();
  }

  /**
   * Relation to transaction model.
   *
   * @return HasMany
   */
  public function transactions(): HasMany
  {
    return $this->hasMany(Transaction::class, 'user_id');
  }

  /**
   * Relation to journal model.
   *
   * @return HasMany
   */
  public function journals(): HasMany
  {
    return $this->hasMany(Journal::class, 'user_id');
  }
}
