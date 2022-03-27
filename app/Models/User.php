<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $guarded = [];

  protected $hidden = [
    'password',
  ];

  protected $casts = [
    'status' => 'boolean',
    'email_verified_at' => 'datetime',
  ];

  protected $appends = ['avatar'];

  public function profile()
  {
    return $this->hasOne(Profile::class, 'user_id');
  }
  public function getAvatarAttribute()
  {
    if (is_null($this->profile->image)) {
      return "https://ui-avatars.com/api/?name={$this->initials}&size=120&background=2463eb&color=fff";
    }
    return asset('storage/' . $this->profile->image);
  }
  public function getFullNameAttribute()
  {
    return $this->profile->first_name . ' ' . $this->profile->last_name;
  }
  public function getActiveAttribute()
  {
    return $this->status ? "Active" : "Inactive";
  }
  public function getInitialsAttribute()
  {
    return str_replace(' ', '+', $this->full_name);
  }
  public function roles(): BelongsToMany
  {
    return $this->belongsToMany(Role::class, 'role_users', 'user_id', 'role_id');
  }
  public function expenses(): HasMany
  {
    return $this->hasMany(Expense::class);
  }
  public function hasPermission($action)
  {
    return $this->roles->map->can($action)->contains(true);
  }
  public function getRoleAttribute()
  {
    return isset($this->roles()->first()->display_name) ? $this->roles()->first()->display_name : null;
  }
  public function tap($callable = null)
  {
    return tap($this, $callable);
  }
  public function getRecentExpense()
  {
    return $this->expenses()->latest()->take(5);
  }
}
