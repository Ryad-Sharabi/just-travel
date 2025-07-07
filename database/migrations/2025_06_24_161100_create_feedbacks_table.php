<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('feedbacks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('flutter_users')->onDelete('cascade');
        $table->string('message');
        $table->string('item_type')->nullable();
        $table->string('item_name')->nullable();
        $table->float('rating')->default(0);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
