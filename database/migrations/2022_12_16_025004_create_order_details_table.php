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
        Schema::create(ORDER_DETAILS_TABLE, function (Blueprint $table) {
            $table->id();
            $table->uuid()->index();
            $table->foreignId('order_id')->constrained();
            $table->foreignId('item_id')->constrained();
            $table->float('amount');
            $table->integer('quantity');
            $table->boolean('is_inventory')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists(ORDER_DETAILS_TABLE);
    }
};
