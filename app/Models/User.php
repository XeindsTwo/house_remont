<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
  use HasFactory;

  protected $fillable = [
    'login',
    'name',
    'email',
    'password',
    'role',
  ];

  public function reviews(): HasMany
  {
    return $this->hasMany(Review::class);
  }
}