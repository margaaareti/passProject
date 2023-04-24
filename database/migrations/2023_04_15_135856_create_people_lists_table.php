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
        Schema::create('people_lists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('signed_by');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('object');
            $table->string('purpose');
            $table->string('contract_number');
            $table->string('equipment')->nullable();
            $table->integer('guests_count')->default(0);
            $table->string('phone_number');

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people_lists');
    }
};
