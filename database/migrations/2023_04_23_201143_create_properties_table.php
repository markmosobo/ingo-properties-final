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
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')
            ->references('id')
            ->on('categories');
            $table->integer('location_id')->unsigned();
            $table->foreign('location_id')
            ->references('id')
            ->on('locations');
            $table->integer('property_type_id')->unsigned()->nullable();
            $table->foreign('property_type_id')
            ->references('id')
            ->on('property_types');
            $table->string('address')->nullable();
            $table->float('price');
            $table->integer('negotiable')->nullable();
            $table->longText('description')->nullable();
            $table->string('location')->nullable();
            $table->string('size')->nullable();
            $table->string('social_link')->nullable();
            $table->string('estate_name')->nullable();
            $table->string('property_status')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('bedrooms')->nullable();
            $table->integer('parking_space')->nullable();
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')
            ->references('id')
            ->on('users');
            $table->integer('status')->nullable()->default(0);
            $table->integer('featured')->nullable()->default(0);
            $table->string('land_type')->nullable();
            $table->string('property_use')->nullable();
            $table->float('land_area')->nullable();
            $table->integer('electricity')->nullable()->default(0);
            $table->integer('air_conditioning')->nullable()->default(0);
            $table->integer('alarm')->nullable()->default(0);
            $table->integer('balcony')->nullable()->default(0);
            $table->integer('chandelier')->nullable()->default(0);
            $table->integer('car_parking')->nullable()->default(0);
            $table->integer('dining_area')->nullable()->default(0);
            $table->integer('dishwasher')->nullable()->default(0);
            $table->integer('gym')->nullable()->default(0);
            $table->integer('hot_water')->nullable()->default(0);
            $table->integer('kitchen_cabinets')->nullable()->default(0);
            $table->integer('kitchen_shelf')->nullable()->default(0);
            $table->integer('microwave')->nullable()->default(0);
            $table->integer('pets_allow')->nullable()->default(0);
            $table->integer('pop_ceiling')->nullable()->default(0);
            $table->integer('prepaid_meter')->nullable()->default(0);
            $table->integer('refrigerator')->nullable()->default(0);
            $table->integer('swimming_pool')->nullable()->default(0);
            $table->integer('tv')->nullable()->default(0);
            $table->integer('wardrobe')->nullable()->default(0);
            $table->integer('wifi')->nullable()->default(0);
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
        Schema::dropIfExists('properties');
    }
};
