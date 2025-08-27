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
        Schema::create('recharge_bulk_pins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bulk_recharge_card_id')->constrained()->onDelete('cascade');
            $table->string('reference');
            $table->string('pin');
            $table->string('serial_number');
            $table->decimal('amount', 15, 2);
            $table->text('instruction')->nullable(); 
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
        Schema::dropIfExists('recharge_bulk_pins');
    }
};
