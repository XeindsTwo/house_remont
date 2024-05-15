<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairEstimatesTable extends Migration
{
  public function up(): void
  {
    Schema::create('repair_estimates', function (Blueprint $table) {
      $table->id();
      $table->string('object');
      $table->string('material');
      $table->string('area');
      $table->string('timing');
      $table->string('phone');
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('repair_estimates');
  }
}