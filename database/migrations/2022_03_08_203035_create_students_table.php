<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('phone2')->nullable();
            $table->longText('barcode')->nullable();
            $table->unsignedBigInteger('user_create');
            $table->foreign('user_create')->on('users')->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedBigInteger('row_id');
            $table->foreign('row_id')->on('rows')->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('students');
    }
};
