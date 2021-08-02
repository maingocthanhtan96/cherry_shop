<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 22:04:24
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelationshipRefProductColorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_product_color', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();

            // $table->index('color_id');
            // $table->foreign('color_id')
            //     ->references('id')
            //     ->on('colors')
            //     ->onDelete('cascade');
            // $table->index('product_id');
            // $table->foreign('product_id')
            //     ->references('id')
            //     ->on('products')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_product_color');
    }
}
