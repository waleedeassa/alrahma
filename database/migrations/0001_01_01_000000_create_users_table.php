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
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('family_name');
      $table->string('email')->unique();
      $table->boolean('status')->default(true);
      $table->timestamp('email_verified_at')->nullable();
      $table->string('photo')->nullable();
      $table->string('phone')->nullable();
      $table->string('password');
      $table->rememberToken();
      $table->timestamps();
    });

    Schema::create('password_reset_tokens', function (Blueprint $table) {
      $table->string('email');
      $table->enum('guard', ['web', 'sponsor'])->default('web');
      $table->string('token');
      $table->timestamp('created_at')->nullable();

      $table->primary(['email', 'guard']);
    });

    Schema::create('sessions', function (Blueprint $table) {
      $table->string('id')->primary();
      $table->foreignId('user_id')->nullable()->index();
      $table->string('ip_address', 45)->nullable();
      $table->text('user_agent')->nullable();
      $table->longText('payload');
      $table->integer('last_activity')->index();
    });

    DB::table('users')->insert([
      [
        'name' => 'admin',
        'family_name'=> 'family',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('12345678'),
        'phone' => '0123456789'
      ]
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('users');
    Schema::dropIfExists('password_reset_tokens');
    Schema::dropIfExists('sessions');
  }
};
