<?php

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
        Schema::create('user_routines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('group_id')->nullable()->references('id')->on('user_time_groups')->onDelete('cascade');
            $table->string('name',100);
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('repeat_time')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('allDay')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_routines');
    }
};
