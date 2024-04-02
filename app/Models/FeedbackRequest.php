<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackRequest extends Model
{
  use HasFactory;

  protected $fillable = [
    'name_feedback',
    'phone_feedback',
    'comment_feedback',
    'file_path',
  ];
}