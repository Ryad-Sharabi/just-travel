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
        Schema::table('cars', function (Blueprint $table) {
            // Add new fields - will be added at the end of the table
            $table->string('image_url')->nullable();
            $table->json('images')->nullable();
            $table->string('category')->nullable();
            $table->integer('seats')->nullable();
            $table->string('transmission')->nullable();
            $table->string('fuel_type')->nullable();
            $table->decimal('price_per_day', 10, 2)->nullable();
            $table->string('currency', 3)->default('USD');
            $table->string('booking_url')->nullable();
            $table->timestamp('last_synced_at')->nullable();
            $table->string('rapidapi_car_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn([
                'image_url',
                'images',
                'category',
                'seats',
                'transmission',
                'fuel_type',
                'price_per_day',
                'currency',
                'booking_url',
                'last_synced_at',
                'rapidapi_car_id',
            ]);
        });
    }
};

