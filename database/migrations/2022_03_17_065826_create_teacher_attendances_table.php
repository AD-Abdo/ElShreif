<?php

use App\Models\Teacher;
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
        Schema::create('teacher_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->on('teachers')->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->longText('comment')->nullable();
            $table->double('salary')->nullable();
            $table->unsignedBigInteger('user_create');
            $table->foreign('user_create')->on('users')->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->integer('month')->default(Carbon::now()->month);
            $table->integer('year')->default(Carbon::now()->year);
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
        Schema::dropIfExists('teacher_attendances');
    }
};
