<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_number')->unique();
            $table->enum('status', [
                'pending',
                'processing',
                'completed',
                'decline',
            ])->default('pending');
            $table->float('total', 10, 2);
            $table->bigInteger('items_count');
            $table->boolean('payment_status')->default(1);

            $table->string('first_name');
            $table->string('last_name');
            $table->text('address');
            $table->text('city');
            $table->text('country');
            $table->text('post_code');
            $table->text('phone_number');
            $table->text('note')->nullable();

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('orders');
    }
}
