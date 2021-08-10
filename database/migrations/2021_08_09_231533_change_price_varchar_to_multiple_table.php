<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePriceVarcharToMultipleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_details', function (Blueprint $table) {
            $table->string('price')->default(0)->change();
        });
        Schema::table('product_payments', function (Blueprint $table) {
            $table->string('price')->default(0)->change();
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
            $table->double('price')->nullable()->change();
        });
        Schema::table('product_payments', function (Blueprint $table) {
            $table->double('price')->nullable()->change();
        });
    }
}
