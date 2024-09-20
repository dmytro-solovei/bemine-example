<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GuestProductAddOptions extends Migration
{
    private const TABLE = 'guest_product';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(self::TABLE, function(Blueprint $table) {
            $table->unsignedInteger('size_id')->after('product_id');
            $table->unsignedInteger('color_id')->after('size_id');
            $table->tinyInteger('count')->after('color_id')->default(1);
            $table->string('address')->after('count');

            $table->foreign('size_id')
                ->references('id')
                ->on('sizes')
                ->onDelete('cascade');

            $table->foreign('color_id')
                ->references('id')
                ->on('colors')
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
        Schema::table(self::TABLE, function(Blueprint $table) {
            $table->dropForeign(['size_id']);
            $table->dropColumn('size_id');
            $table->dropForeign(['color_id']);
            $table->dropColumn('color_id');
            $table->dropColumn('count');
        });
    }
}
