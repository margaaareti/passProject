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
        Schema::create('property_applications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('application_type')->nullable();
            $table->string('type')->nullable('false');
            $table->string('application_number')->nullable("");
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('is_approved')->default(false);
            $table->foreignId('approved_by')->nullable()->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('property-in-date')->nullable();
            $table->date('property-out-date')->nullable();
            $table->string('signed_by')->nullable(false);
            $table->string('object_in')->nullable();
            $table->string('object_out')->nullable();
//            $table->string('rooms')->nullable();
            $table->string('purpose')->nullable(false);
//          $table->string('contract_number')->nullable();
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
        Schema::dropIfExists('property_applications');
    }
};
