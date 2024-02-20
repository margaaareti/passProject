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

            $table->string('rooms')->nullable();

            $table->integer('guests_count')->default(0);

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
