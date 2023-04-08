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
            $table->id('companies_id');
            $table->date('monday_start');
            $table->date('monday_end');
            $table->date('tuesday_start');
            $table->date('tuesday_end');
            $table->date('wednesday_start');
            $table->date('wednesday_end');
            $table->date('thursday_start');
            $table->date('thursday_end');
            $table->date('friday_start');
            $table->date('friday_end');
            $table->date('saturday_start');
            $table->date('saturday_end');
            $table->date('sunday_start');
            $table->date('sunday_end');
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
