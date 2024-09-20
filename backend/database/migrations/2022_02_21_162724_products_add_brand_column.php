<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductsAddBrandColumn extends Migration
{
    private const TABLE = 'products';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(static::TABLE, function (Blueprint $table) {
            $table->bigInteger('brand_id')->unsigned()->after('id');

            $table->foreign('brand_id')
                ->references('id')
                ->on('product_brands')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(static::TABLE, function (Blueprint $table) {
            $table->dropForeign('products_brand_id_foreign');
            $table->dropColumn('brand_id');
        });
    }
}
