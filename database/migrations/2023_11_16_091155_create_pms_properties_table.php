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
        Schema::create('pms_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('landlord_id')
            ->unsigned();
            $table->string('units_no');
            $table->foreign('landlord_id')
            ->references('id')
            ->on('landlords')
            ->onDelete('cascade');
            $table->integer('commission')->nullable();            
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
        Schema::dropIfExists('pms_properties');
    }
};
