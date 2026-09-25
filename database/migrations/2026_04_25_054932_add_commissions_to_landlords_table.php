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
        Schema::table('landlords', function (Blueprint $table) {
            $table->decimal('commission', 8, 2)->nullable()->after('phone_no');
            $table->decimal('fixed_commission', 10, 2)->nullable()->after('commission');

            $table->string('address')->nullable()->after('fixed_commission');
            $table->string('id_number')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('landlords', function (Blueprint $table) {
            $table->dropColumn(['commission', 'fixed_commission']);  
        });
    }
};
