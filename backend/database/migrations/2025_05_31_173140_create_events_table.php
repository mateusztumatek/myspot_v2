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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('created_by')->constrained('users');
            $table->string('name', 255);
            $table->longText('description')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('event_categories');

            // Location details
            $table->string('location_name', 255)->nullable();
            $table->decimal('location_latitude', 10, 8)->nullable();
            $table->decimal('location_longitude', 11, 8)->nullable();
            $table->dateTime('start_at');
            $table->dateTime('end_at')->nullable();

            // Event sign up options
            $table->smallInteger('visibility')->default(\App\Consts\EventVisibility::PRIVATE);
            $table->integer('max_attendees')->nullable();
            $table->dateTime('sign_up_until')->nullable();
            $table->string('user_visibility', 100);

            // Event payment options
            $table->boolean('paid')->default(false);
            $table->json('payment_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
