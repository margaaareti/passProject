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
        Schema::create('car_applications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('application_type')->nullable();
            $table->string('application_number')->nullable(false);
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('is_approved')->default(false);
            $table->foreignId('approved_by')->nullable()->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('start_date')->nullable(false);
            $table->date('end_date')->nullable(false);
            $table->string('signed_by')->nullable(false);
            $table->string('object')->nullable(false);
            $table->string('purpose')->nullable(false);
            $table->string('equipment', 1000)->nullable();
            $table->integer('cars_count')->default(0);
            $table->string('responsible_person')->nullable(false);
            $table->string('phone_number')->nullable(false);
            $table->string('additional_info', 300)->nullable();
            $table->boolean('viewed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_applications');
    }
};
