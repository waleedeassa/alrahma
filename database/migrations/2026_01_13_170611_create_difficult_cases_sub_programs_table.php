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
    Schema::create('difficult_cases_sub_programs', function (Blueprint $table) {
      $table->id();
      $table->foreignId('support_program_id')->constrained('support_programs')->onDelete('cascade');
      $table->foreignId('difficult_case_family_id')->constrained('difficult_case_families')->onDelete('cascade');
      $table->date('date');
      $table->timestamps();
      $table->index(['support_program_id', 'date']);
    });
  }
  public function down(): void
  {
    Schema::dropIfExists('difficult_cases_sub_programs');
  }
};
