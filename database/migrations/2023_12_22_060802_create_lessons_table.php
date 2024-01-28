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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();

            // relationships
            // Lesson has an invoice
            $table->unsignedBigInteger("invoice_id")->nullable()->default(null);

            $table->unsignedBigInteger("teacher_id");
            $table->unsignedBigInteger("student_id");
            $table->unsignedBigInteger("instrument_id");

            // boolean completed
            $table->boolean("completed")->default(false);

            $table->double("price")->default(0);
            $table->integer("duration")->default(30);
            $table->text("notes")->nullable()->default(null);


            // todo - fix these
            $table->dateTime("start_time")->nullable()->default(now());
            $table->dateTime("end_time")->nullable()->default(now());

            // todo - do I need these?
//            $table->foreign('teacher_id')->references('id')->on('users');
//            $table->foreign('student_id')->references('id')->on('users');
//            $table->foreign('instrument_id')->references('id')->on('instruments');

            $table->index(['teacher_id', 'student_id', 'instrument_id', 'start_time', 'end_time'], 'lesson_compound_index');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropIndex('lesson_compound_index'); // Drops the index
        });
        Schema::dropIfExists('lessons');
    }
};
