<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDetaulAmountToMultipleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_details', function (Blueprint $table) {
            $table->integer('amount')->default(0)->change();
        });
        Schema::table('members', function (Blueprint $table) {
            $table->integer('amount')->default(0)->change();
        });
        Schema::table('product_rejects', function (Blueprint $table) {
            $table->integer('total')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_details', function (Blueprint $table) {
            $table->integer('amount')->nullable()->change();
        });
        Schema::table('members', function (Blueprint $table) {
            $table->integer('amount')->nullable()->change();
        });
        Schema::table('product_rejects', function (Blueprint $table) {
            $table->integer('total')->nullable()->change();
        });
    }
}
