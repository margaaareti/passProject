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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            //$table->string('last_name')->nullable(false);
            //$table->string('patronymic')->nullable(false);
            //$table->string('department')->nullable(false);
           // $table->string('isu_number')->nullable();
            $table->string('email')->unique()->nullable(false);
           // $table->string('phone_number')->unique()->nullable(false);
            $table->timestamp('email_verified_at')->nullable();
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
