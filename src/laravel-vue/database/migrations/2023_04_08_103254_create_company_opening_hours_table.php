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
            $table->date('monday_start')->nullable();
            $table->date('monday_end')->nullable();
            $table->date('tuesday_start')->nullable();
            $table->date('tuesday_end')->nullable();
            $table->date('wednesday_start')->nullable();
            $table->date('wednesday_end')->nullable();
            $table->date('thursday_start')->nullable();
            $table->date('thursday_end')->nullable();
            $table->date('friday_start')->nullable();
            $table->date('friday_end')->nullable();
            $table->date('saturday_start')->nullable();
            $table->date('saturday_end')->nullable();
            $table->date('sunday_start')->nullable();
            $table->date('sunday_end')->nullable();
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
