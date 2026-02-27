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
    Schema::create('special_needs_sub_programs', function (Blueprint $table) {
      $table->id();
      $table->foreignId('support_program_id')->constrained('support_programs')->onDelete('cascade');
      $table->foreignId('special_needs_person_id')->constrained('special_needs_people')->onDelete('cascade');
      $table->date('date');
      $table->timestamps();
      $table->index(['support_program_id', 'date'], 'snp_sub_prog_index');
    });
  }
  public function down(): void
  {
    Schema::dropIfExists('special_needs_sub_programs');
  }
};
