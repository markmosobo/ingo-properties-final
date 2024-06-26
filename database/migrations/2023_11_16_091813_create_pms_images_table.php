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
        Schema::create('pms_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('property_id')
            ->unsigned();
            $table->foreign('property_id')
            ->references('id')
            ->on('pms_properties')
            ->onDelete('cascade');
            $table->string('name', 255);            
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
        Schema::dropIfExists('pms_images');
    }
};
