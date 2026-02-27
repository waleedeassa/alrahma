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
    Schema::create('difficult_case_families', function (Blueprint $table) {
      $table->id();
      $table->date('registration_date');
      $table->string('first_name_ar');
      $table->string('last_name_ar');
      $table->string('first_name_fr');
      $table->string('last_name_fr');
      $table->text('national_id_no');
      $table->unsignedTinyInteger('gender');
      $table->date('birth_date');
      $table->unsignedTinyInteger('education_level');
      $table->tinyInteger('family_members_count');
      $table->unsignedTinyInteger('difficult_case_type');
      $table->unsignedTinyInteger('social_status');
      $table->foreignId('governorate_id')->constrained('governorates')->cascadeOnUpdate()->restrictOnDelete();
      $table->foreignId('city_id')->constrained('cities')->cascadeOnUpdate()->restrictOnDelete();
      $table->text('address');
      $table->string('phone');
      $table->foreignId('added_by')->constrained('users');
      $table->foreignId('updated_by')->nullable()->constrained('users');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('difficult_case_families');
  }
};
