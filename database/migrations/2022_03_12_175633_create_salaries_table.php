<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->double('salary');
            $table->longText('notes')->nullable();
            $table->longText('admin_notes')->nullable();
            $table->unsignedBigInteger('user_create');
            $table->foreign('user_create')->on('users')->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->on('students')->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->date('date')->default(Carbon::now());
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
        Schema::dropIfExists('salaries');
    }
};
