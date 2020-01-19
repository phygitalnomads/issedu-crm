<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmProfessorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_professors', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('crm_id');
            $table->string('name')->nullable()->default(null);
            $table->string('url')->nullable()->default(null);
            $table->bigInteger('contact_id')->nullable()->default(null);
            $table->integer('status_id')->nullable()->default(null);
            $table->bigInteger('user_id')->nullable()->default(null);
            $table->integer('deleted')->nullable()->default(null);
            $table->bigInteger('business_id')->nullable()->default(null);
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
        Schema::dropIfExists('crm_professors');
    }
}
