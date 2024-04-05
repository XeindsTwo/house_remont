<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('works', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->integer('year');
      $table->string('cost')->nullable();
      $table->text('description')->nullable();
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('works');
  }
};
