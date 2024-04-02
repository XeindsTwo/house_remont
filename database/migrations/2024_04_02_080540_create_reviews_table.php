<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
  public function up(): void
  {
    Schema::create('reviews', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->text('content');
      $table->boolean('status')->default(false);
      $table->string('name');
      $table->string('photo');
      $table->string('phone');
      $table->timestamps();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('reviews');
  }
}