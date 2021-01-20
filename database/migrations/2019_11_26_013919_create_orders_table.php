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
            $table->string('reserve_header_id');
            $table->string('process_code');
            $table->string('reserve_number');
            $table->string('reserve_date');
            $table->string('curr_acc_code');
            $table->string('curr_acc_description')->nullable();
            $table->string('warehouse_code')->nullable();
            $table->string('customer_name')->nullable();
            $table->integer('quantity')->nullable();
            $table->double('total_cost')->nullable();
            $table->string('picker_id')->nullable();
            $table->dateTime('assign_time')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->integer('elapsed_time')->nullable();
            $table->text('note')->nullable();
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
