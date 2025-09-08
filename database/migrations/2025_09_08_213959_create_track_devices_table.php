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
        Schema::create('track_devices', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->string('country');
            $table->string('city');
            $table->string('flag')->nullable();
            $table->string('device_type');
            $table->string('platform')->nullable();
            $table->string('browser')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track_devices');
    }
};
