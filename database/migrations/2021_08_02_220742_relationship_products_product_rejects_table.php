<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 22:07:42
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelationshipProductsProductRejectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_rejects', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable()->after('id');

            // $table->index('product_id');
            // $table->foreign('product_id')
            //     ->references('id')->on('products')
            //    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_rejects', function (Blueprint $table) {
            $table->dropColumn('product_id');
            // $table->dropForeign('product_id');
        });
    }
}
