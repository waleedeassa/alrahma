<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    // ── 1- Add social_category column to special_needs_people table and make it nullable ──────────────────────
    Schema::table('special_needs_people', function (Blueprint $table) {
      $table->unsignedTinyInteger('social_category')
        ->nullable()
        ->after('social_status')
        ->comment('الحالة الاجتماعية');
    });

    // ── 2- Fill the social_category column for existing records with a default value (e.g., 6) ─────────────────────
    DB::table('special_needs_people')
      ->whereNull('social_category')
      ->update(['social_category' => 6]);

    // ── 3- Make the social_category column non-nullable ─────────────────────────────────────────────────────────────
    Schema::table('special_needs_people', function (Blueprint $table) {
      $table->unsignedTinyInteger('social_category')
        ->nullable(false)
        ->comment('الحالة الاجتماعية')
        ->change();
    });
  }

  public function down(): void
  {
    Schema::table('special_needs_people', function (Blueprint $table) {
      $table->dropColumn('social_category');
    });
  }
};
