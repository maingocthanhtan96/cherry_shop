<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:53:12
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
			$table->bigIncrements("id");
            $table->string("code", 191);
            $table->string("name", 191);
            $table->string("image", 191)->nullable();
            $table->text("description")->nullable();
            $table->integer("stock_in")->nullable();
            $table->integer("stock_out")->nullable();
            $table->integer("inventory")->nullable();
            $table->float("price")->nullable();
            $table->integer("discount")->nullable();
            $table->boolean("status")->nullable()->default("1");
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
