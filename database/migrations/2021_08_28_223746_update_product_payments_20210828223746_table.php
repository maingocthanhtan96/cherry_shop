<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-28 22:37:46
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductPayments20210828223746Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_payments', function (Blueprint $table) {
			$table->json("details")->nullable()->after("note"); // Update
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_payments', function (Blueprint $table) {
            $table->dropColumn("details"); //Drop Update
        });
    }
}
