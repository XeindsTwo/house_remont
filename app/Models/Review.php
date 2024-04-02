<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
  protected $fillable = [
    'user_id',
    'content',
    'status',
    'photo',
    'phone',
    'name',
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}