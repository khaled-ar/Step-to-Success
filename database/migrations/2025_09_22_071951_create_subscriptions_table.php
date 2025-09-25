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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('course_id')->nullable()->constrained('courses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('subscribable'); //single_course,all_courses
            $table->float('total', 1);
            $table->string('type'); // scientific,literary
            $table->enum('status', ['confirmation_waiting','pending','active','inactive'])->default('confirmation_waiting');
            $table->string('transfer_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
