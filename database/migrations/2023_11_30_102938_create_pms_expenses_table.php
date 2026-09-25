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
        Schema::create('pms_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref_no')->nullable();
            $table->integer('pms_property_id')->unsigned();
            $table->integer('pms_unit_id')->unsigned();            
            $table->string('payment_type')->nullable();
            $table->string('paid_to')->nullable();
            $table->float('amount_paid')->nullable();
            $table->integer('checked_by')->unsigned();
            $table->foreign('pms_property_id')
            ->references('id')
            ->on('pms_properties')
            ->onDelete('cascade');  
            $table->foreign('pms_unit_id')
            ->references('id')
            ->on('pms_units')
            ->onDelete('cascade');             
            $table->foreign('checked_by')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
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
        Schema::dropIfExists('pms_expenses');
    }
};
