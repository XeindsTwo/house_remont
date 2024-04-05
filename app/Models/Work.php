<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Work extends Model
{
  protected $fillable = [
    'title',
    'year',
    'cost',
    'description'
  ];

  public function photos(): HasMany
  {
    return $this->hasMany(WorkPhoto::class);
  }
}