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
        Schema::create('company_opening_hours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('companies_id');
            $table->dateTime('monday_start')->nullable();
            $table->dateTime('monday_end')->nullable();
            $table->dateTime('tuesday_start')->nullable();
            $table->dateTime('tuesday_end')->nullable();
            $table->dateTime('wednesday_start')->nullable();
            $table->dateTime('wednesday_end')->nullable();
            $table->dateTime('thursday_start')->nullable();
            $table->dateTime('thursday_end')->nullable();
            $table->dateTime('friday_start')->nullable();
            $table->dateTime('friday_end')->nullable();
            $table->dateTime('saturday_start')->nullable();
            $table->dateTime('saturday_end')->nullable();
            $table->dateTime('sunday_start')->nullable();
            $table->dateTime('sunday_end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_opening_hours');
    }
};
