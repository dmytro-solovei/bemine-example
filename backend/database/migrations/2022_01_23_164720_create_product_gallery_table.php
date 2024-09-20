<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Classes\Enum\ProductGallerySizeEnum;

class CreateProductGalleryTable extends Migration
{
    private const TABLE = 'product_gallery';

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
            $table->enum('type', ProductGallerySizeEnum::toArray());
            $table->tinyInteger('block')->unsigned();
            $table->string('image');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            //todo
//            $table->foreign('block')
//                ->references('block')
//                ->on('product_properties')
//                ->onDelete('cascade');

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
