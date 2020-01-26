<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailToCrmStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crm_students', function (Blueprint $table) {
            $table->string('email')->after('crm_id')->nullable();
        });
        Schema::table('crm_professors', function (Blueprint $table) {
            $table->string('email')->after('crm_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crm_students', function (Blueprint $table) {
            $table->dropColumn('email');
        });
        Schema::table('crm_professors', function (Blueprint $table) {
            $table->dropColumn('email');
        });
    }
}
