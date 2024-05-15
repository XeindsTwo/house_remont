<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairEstimate extends Model
{
  protected $fillable = [
    'object',
    'material',
    'area',
    'timing',
    'phone',
  ];
}