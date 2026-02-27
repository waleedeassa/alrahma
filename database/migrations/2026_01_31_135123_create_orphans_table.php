<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('orphans', function (Blueprint $table) {
      $table->id();
      $table->foreignId('sponsor_id')->nullable()->constrained('sponsors')->cascadeOnUpdate()->restrictOnDelete();
      $table->foreignId('family_id')->nullable()->constrained('families')->cascadeOnUpdate()->restrictOnDelete();
      $table->foreignId('supervisor_id')->nullable()->constrained('users')->cascadeOnUpdate()->restrictOnDelete();
      $table->string('orphan_sponsorship_code')->nullable();
      $table->unsignedTinyInteger('cancellation_reason')->nullable();
      $table->string('name_ar');
      $table->string('name_fr');
      $table->string('family_name_ar');
      $table->string('family_name_fr');
      $table->date('birth_date');
      $table->unsignedTinyInteger('gender');
      $table->foreignId('governorate_id')->nullable()->constrained('governorates')->cascadeOnUpdate()->nullOnDelete();
      $table->foreignId('city_id')->nullable()->constrained('cities')->cascadeOnUpdate()->nullOnDelete();
      $table->string('city_in_french');
      $table->string('address');
      $table->string('address_in_french');
      $table->string('arrangement_between_brothers');
      $table->unsignedTinyInteger('income_status');
      $table->string('other_income');
      $table->unsignedTinyInteger('academic_level');
      $table->string('shoe_size');
      $table->string('clothes_size');
      $table->string('phone');
      $table->unsignedTinyInteger('blood_type');
      $table->unsignedTinyInteger('health_status');
      $table->string('image')->nullable();
      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('orphans');
  }
};
