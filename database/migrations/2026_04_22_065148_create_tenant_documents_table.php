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
        Schema::create('tenant_documents', function (Blueprint $table) {
            $table->increments('id'); // <-- CHANGE THIS

            $table->unsignedInteger('tenant_id');
            $table->string('type')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();

            $table->unsignedInteger('uploaded_by')->nullable();

            $table->timestamps();

            $table->foreign('tenant_id')
                ->references('id')
                ->on('pms_tenants')
                ->onDelete('cascade');

            $table->foreign('uploaded_by')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenant_documents');
    }
};
