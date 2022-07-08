<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachQualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coach_quals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('qual_id')
                ->references('id')->on('qualifications');

            $table->foreignId('coach_id')
                ->references('id')->on('coaches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coach_quals');
    }
}
