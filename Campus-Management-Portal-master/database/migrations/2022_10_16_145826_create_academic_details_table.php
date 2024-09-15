<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_details', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('title');
            $table->string('exam_type');
            $table->string('reg_no');
            $table->year('passing_year');
            $table->foreignId('organization_id')->references('id')->on('organizations')->constrained();
            $table->unsignedSmallInteger('obtained_marks');
            $table->unsignedSmallInteger('total_marks');
            $table->foreignId('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_details');
    }
}
