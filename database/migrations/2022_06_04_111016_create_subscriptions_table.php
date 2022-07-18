<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->references('id')->on('users');
            $table->date('starts_at');
            $table->date('ends_at');
            $table->boolean('private');
            $table->integer('price');
            $table->boolean('fully_paid');
            $table->integer('paid_amount');
            $table->foreignId('coach_id')
                ->references('id')->on('coaches')->nullable();
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
        Schema::dropIfExists('subscriptions');
    }
}
