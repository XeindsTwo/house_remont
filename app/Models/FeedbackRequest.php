<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackRequest extends Model
{
  protected $fillable = [
    'name_feedback',
    'phone_feedback',
    'comment_feedback',
    'file_path',
  ];
}