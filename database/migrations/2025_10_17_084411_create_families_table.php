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
    Schema::create('families', function (Blueprint $table) {
      //address connection with governorate and city
      $table->id();
      $table->string("orphan_guardian_name");
      $table->unsignedTinyInteger("relationship_to_the_orphan");
      $table->string("phone1");
      $table->string("phone2")->nullable();
      $table->string("address");
      $table->foreignId('governorate_id')->constrained('governorates')->cascadeOnUpdate()->restrictOnDelete();
      $table->foreignId('city_id')->constrained('cities')->cascadeOnUpdate()->restrictOnDelete();
      // father information
      $table->string("father_job");  
      $table->unsignedTinyInteger("father_death_reason");
      $table->date("father_death_date");
      // mother information
      $table->boolean("mother_alive");
      $table->date("mother_death_date")->nullable();
      $table->unsignedTinyInteger("mother_death_reason")->nullable();
      $table->string("mother_name");
      $table->date("mother_birth_date");
      $table->string("mother_family_name");
      $table->string("mother_name_in_french");
      $table->string("mother_family_name_in_french");
      $table->text("mother_id_no");
      $table->date("mother_id_expire_date");
      $table->text("bank_account_number");
      $table->unsignedTinyInteger("medical_insurance");
      $table->unsignedTinyInteger("mother_health_status");
      $table->tinyInteger("number_of_family_members");
      $table->unsignedTinyInteger("mother_education_level");
      $table->unsignedTinyInteger("mother_qualifications");
      $table->boolean("does_mother_work");
      $table->unsignedTinyInteger("mother_working_type")->nullable();
      $table->boolean("mother_widows_support");
      $table->decimal("mother_widows_support_amount", 10, 2)->nullable();
      $table->boolean("has_retirement_compensation");
      $table->decimal("husband_retirement_compensation_amount", 10, 2)->nullable();
      $table->boolean("is_there_another_source_of_income");
      $table->unsignedTinyInteger("mother_other_income_type")->nullable();
      $table->decimal("mother_other_income_amount", 10, 2)->nullable();
      $table->boolean("is_mother_other_income_fixed")->nullable();
      // housing information
      $table->unsignedTinyInteger("housing_ownership");
      $table->unsignedTinyInteger("housing_type");
      $table->unsignedTinyInteger("housing_status");
      $table->unsignedTinyInteger("housing_area");
      //family breadwinner information
      $table->boolean("has_breadwinner");
      $table->string("breadwinner_name")->nullable();
      $table->string("breadwinner_french_name")->nullable();
      $table->string("breadwinner_family_name")->nullable();
      $table->string("breadwinner_family_in_french")->nullable();
      $table->string("breadwinner_job")->nullable();
      $table->text("breadwinner_id_no")->nullable();
      $table->string("breadwinner_phone")->nullable();
      $table->foreignId('added_by')->nullable()->constrained('users')->restrictOnDelete();
      $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
      $table->softDeletes();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('families');
  }
};
