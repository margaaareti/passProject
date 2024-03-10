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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->morphs('applicationable');

            $table->string('application_type')->nullable(false);
            $table->string('application_number')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('status')->nullable();
            $table->foreignId('approved_by')->nullable()->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('start_date')->nullable(false);
            $table->date('end_date')->nullable(false);
            $table->string('signed_by')->nullable(false);
            $table->string('object')->nullable(false);
            $table->string('purpose')->nullable(false);
            $table->string('contract_number')->nullable();
            $table->string('equipment', 1000)->nullable();
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
        Schema::dropIfExists('applications');
    }
};
