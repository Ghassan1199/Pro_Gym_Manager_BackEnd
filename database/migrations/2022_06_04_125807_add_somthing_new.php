<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomthingNew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('gym_id')
                ->references('id')->on('gyms');
        });
        Schema::table('gyms', function (Blueprint $table) {
            $table->foreignId('admin_id')->unique()
                ->references('id')->on('admins');
        });
        Schema::table('days', function (Blueprint $table) {
            $table->foreignId('sub_id')
                ->references('id')->on('subscriptions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_exes', function (Blueprint $table) {
            //
        });
    }
}
