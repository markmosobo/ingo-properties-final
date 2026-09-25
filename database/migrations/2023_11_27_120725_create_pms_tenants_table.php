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
        Schema::create('pms_tenants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pms_property_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->integer('id_number')->nullable();
            $table->integer('phone_number')->nullable();
            $table->integer('pms_unit_id')->unsigned();
            $table->integer('status')->default(1);
            $table->foreign('pms_property_id')
            ->references('id')
            ->on('pms_properties')
            ->onDelete('cascade');  
            $table->foreign('pms_unit_id')
            ->references('id')
            ->on('pms_units')
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
        Schema::dropIfExists('pms_tenants');
    }
};
