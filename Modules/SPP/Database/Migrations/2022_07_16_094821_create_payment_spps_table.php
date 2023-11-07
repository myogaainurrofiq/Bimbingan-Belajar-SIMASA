<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentSppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_spps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->bigInteger('year');
            $table->boolean('is_active');
            $table->enum('January', ['paid', 'unpaid', 'pending', 'free'])->default('unpaid');
            $table->enum('February', ['paid', 'unpaid', 'pending', 'free'])->default('unpaid');
            $table->enum('March', ['paid', 'unpaid', 'pending', 'free'])->default('unpaid');
            $table->enum('April', ['paid', 'unpaid', 'pending', 'free'])->default('unpaid');
            $table->enum('May', ['paid', 'unpaid', 'pending', 'free'])->default('unpaid');
            $table->enum('June', ['paid', 'unpaid', 'pending', 'free'])->default('unpaid');
            $table->enum('July', ['paid', 'unpaid', 'pending', 'free'])->default('unpaid');
            $table->enum('August', ['paid', 'unpaid', 'pending', 'free'])->default('unpaid');
            $table->enum('September', ['paid', 'unpaid', 'pending', 'free'])->default('unpaid');
            $table->enum('October', ['paid', 'unpaid', 'pending', 'free'])->default('unpaid');
            $table->enum('November', ['paid', 'unpaid', 'pending', 'free'])->default('unpaid');
            $table->enum('December', ['paid', 'unpaid', 'pending', 'free'])->default('unpaid');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_spps');
    }
}
