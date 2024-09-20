<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopularByTable extends Migration
{
    private const TABLE = 'popular_by';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->boolean(\App\Classes\Enum\PopularByEnum::BEST_SELLER()->getValue())->default(false);
            $table->boolean(\App\Classes\Enum\PopularByEnum::TOP_RATED()->getValue())->default(false);
            $table->boolean(\App\Classes\Enum\PopularByEnum::NEW_ARRIVAL()->getValue())->default(false);

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
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
        Schema::dropIfExists(self::TABLE);
    }
}
