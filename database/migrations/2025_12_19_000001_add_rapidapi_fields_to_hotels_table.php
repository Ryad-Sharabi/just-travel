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
        Schema::table('hotels', function (Blueprint $table) {
            // Add new fields - will be added at the end of the table
            $table->string('image_url')->nullable();
            $table->json('images')->nullable();
            $table->decimal('rating', 3, 2)->nullable();
            $table->integer('review_count')->nullable();
            $table->text('description')->nullable();
            $table->json('amenities')->nullable();
            $table->decimal('price_per_night', 10, 2)->nullable();
            $table->string('currency', 3)->default('USD');
            $table->string('booking_url')->nullable();
            $table->timestamp('last_synced_at')->nullable();
            $table->string('rapidapi_hotel_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn([
                'image_url',
                'images',
                'rating',
                'review_count',
                'description',
                'amenities',
                'price_per_night',
                'currency',
                'booking_url',
                'last_synced_at',
                'rapidapi_hotel_id',
            ]);
        });
    }
};

