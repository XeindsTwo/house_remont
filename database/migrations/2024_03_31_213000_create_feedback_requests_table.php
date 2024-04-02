<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackRequestsTable extends Migration
{
  public function up(): void
  {
    Schema::create('feedback_requests', function (Blueprint $table) {
      $table->id();
      $table->string('name_feedback');
      $table->string('phone_feedback');
      $table->text('comment_feedback')->nullable();
      $table->string('file_path')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('feedback_requests');
  }
}