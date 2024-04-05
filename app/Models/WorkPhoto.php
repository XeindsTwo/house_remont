<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkPhoto extends Model
{
  protected $fillable = [
    'work_id',
    'photo_path'
  ];

  public function work(): BelongsTo
  {
    return $this->belongsTo(Work::class);
  }
}