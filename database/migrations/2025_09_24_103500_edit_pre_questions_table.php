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
        Schema::table('pre_questions', function (Blueprint $table) {
            $table->dropForeign('pre_questions_unit_id_foreign');
            $table->dropColumn('unit_id');
            $table->foreignId('course_id')->after('id')->nullable()->constrained('courses')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('pre_questions', function (Blueprint $table) {
            $table->dropForeign('pre_questions_course_id_foreign');
            $table->dropColumn('course_id');
            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }
};
