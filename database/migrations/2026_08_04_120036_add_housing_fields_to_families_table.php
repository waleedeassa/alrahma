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
    Schema::table('families', function (Blueprint $table) {
      $table->decimal('rent_amount', 10, 2)->nullable()->after('housing_ownership');
      $table->boolean('has_water')->default(0)->after('housing_area');
      $table->boolean('has_electricity')->default(0)->after('has_water');
      $table->boolean('has_sewage')->default(0)->after('has_electricity');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('families', function (Blueprint $table) {
      $table->dropColumn(['rent_amount', 'has_water', 'has_electricity', 'has_sewage']);
    });
  }
};
