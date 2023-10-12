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
        Schema::create('people_applications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('signed_by')->nullable(false);
            $table->date('start_date')->nullable(false);
            $table->date('end_date')->nullable(false);
            $table->string('object')->nullable(false);
            $table->string('rooms')->nullable();
            $table->string('purpose')->nullable(false);
            $table->string('contract_number')->nullable();
            $table->string('equipment', 1000)->nullable();
            $table->integer('guests_count')->default(0);
            $table->string('responsible_person')->nullable(false);
            $table->string('phone_number')->nullable(false);
            $table->string('additional_info', 300)->nullable();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people_applications');
    }
};
