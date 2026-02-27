<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('sponsors', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->unsignedTinyInteger("type");
      $table->string('email')->unique();
      $table->boolean('status')->default(true);
      $table->string('address')->nullable();
      $table->string('photo')->nullable();
      $table->string('phone')->unique();
      $table->string('password');
      $table->softDeletes();
      $table->timestamps();
    });

    DB::table('sponsors')->insert([
      [
        'name' => 'الإغاثة الإسلامية هولندا',
        'type' => '1',
        'email' => 'sponsor@gmail.com',
        'password' => Hash::make('12345678'),
        'phone' => '0123456789',
        'status' => true,
        'address' => 'address',
      ]
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('sponsors');
  }
};
