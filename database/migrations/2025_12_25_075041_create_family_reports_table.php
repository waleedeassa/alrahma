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
    Schema::create('family_reports', function (Blueprint $table) {
      $table->id();
      $table->foreignId('family_id')->constrained('families')->cascadeOnDelete();
      $table->unsignedTinyInteger('sufficiency');
      $table->string('basic_food');
      $table->unsignedTinyInteger('time_to_doctor');
      $table->unsignedTinyInteger('time_to_hospital');
      $table->boolean('sewage_system');
      $table->unsignedTinyInteger('electricity_network');
      $table->unsignedTinyInteger('water_network');
      $table->unsignedTinyInteger('kitchen_setup');
      $table->unsignedTinyInteger('cooking_method');
      $table->unsignedTinyInteger('bathroom_setup');
      $table->unsignedTinyInteger('refrigerator_condition');
      $table->unsignedTinyInteger('wardrobe_condition');
      $table->unsignedTinyInteger('bed_condition');
      $table->unsignedTinyInteger('salon_condition');
      $table->boolean('has_tv');
      $table->boolean('has_mobile_phone');
      $table->boolean('has_computer');
      $table->unsignedTinyInteger('blankets_sufficiency');
      $table->unsignedTinyInteger('winter_clothes_sufficiency');
      $table->unsignedTinyInteger('summer_clothes_sufficiency');
      $table->string('benefits_received_details');
      $table->boolean('educational_activities_benefit');
      $table->string('educational_activities_reason')->nullable();
      $table->string('family_changes_marriage_divorce');
      $table->string('family_changes_employment');
      $table->string('family_changes_relocation');
      $table->string('home_repairs_details');
      $table->string('new_furniture_details');
      $table->string('sponsorship_spending');
      $table->string('family_year_summary');
      $table->string('family_orphan_wish');
      $table->unsignedTinyInteger('family_changes_after_sponsored');
      $table->unsignedTinyInteger('family_changes_after_sponsored_2')->nullable();
      $table->unsignedTinyInteger('family_changes_after_sponsored_3')->nullable();
      $table->foreignId('added_by')->constrained('users')->restrictOnDelete();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('family_reports');
  }
};
