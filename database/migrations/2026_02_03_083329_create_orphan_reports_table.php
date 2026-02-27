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
    Schema::create('orphan_reports', function (Blueprint $table) {
      $table->id();
      $table->foreignId('orphan_id')->constrained('orphans')->onDelete('cascade')->onUpdate('cascade');
      $table->string('name');
      $table->string('family_name');
      $table->unsignedTinyInteger('health_status');
      $table->unsignedTinyInteger('going_to_nearest_doctor_or_hospital_time');
      $table->unsignedTinyInteger('education');
      $table->unsignedTinyInteger('going_to_school_by');
      $table->unsignedTinyInteger('going_to_nearest_school_time');
      $table->unsignedTinyInteger('preferred_subject');
      $table->unsignedTinyInteger('unpreferred_subject');
      $table->unsignedTinyInteger('personal');
      $table->unsignedTinyInteger('like_to_become');
      $table->unsignedTinyInteger('school_progress');
      $table->unsignedTinyInteger('quality_of_housing');
      $table->unsignedTinyInteger('dwelling_place');
      $table->unsignedTinyInteger('type_of_dwelling');
      $table->unsignedTinyInteger('hobbies');
      $table->unsignedTinyInteger('favorite_food');
      $table->unsignedTinyInteger('basic_food');
      $table->string('school_name')->nullable();
      $table->string('first_term_average', 10)->nullable();
      $table->string('second_term_average', 10)->nullable();
      $table->unsignedTinyInteger('end_year_decision')->nullable();
      $table->unsignedTinyInteger('educational_level_changes')->nullable();
      $table->string('supervisor_notes')->nullable();
      $table->foreignId('added_by')->nullable()->constrained('users')->nullOnDelete();
      $table->foreignId('edited_by')->nullable()->constrained('users')->nullOnDelete();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('orphan_reports');
  }
};
