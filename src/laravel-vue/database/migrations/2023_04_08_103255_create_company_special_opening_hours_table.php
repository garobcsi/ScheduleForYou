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
        Schema::create('company_special_opening_hours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opening_hours_id')->references('companies_id')->on('company_opening_hours')->onDelete('cascade');
            $table->date('start');
            $table->date('end');
            $table->string('open_or_close');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_special_opening_hours');
    }
};
