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
    Schema::create('support_program_entries', function (Blueprint $table) {
      $table->id();
      $table->foreignId('support_program_id')->constrained('support_programs')->onDelete('cascade');
      $table->string('beneficiary_category');
      $table->unsignedInteger('beneficiaries_count');
      $table->string('funding_source'); 
      $table->date('date');
      $table->string('notes')->nullable();
      $table->timestamps();

      // $table->index(['support_program_id', 'beneficiary_category']);
      $table->index(['support_program_id', 'beneficiary_category'], 'spe_program_category_index');
      $table->index('date');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('support_program_entries');
  }
};
