<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageSlidesTable extends Migration
{
    private const TABLE = 'page_slides';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->unsignedTinyInteger('page_id');
            $table->unsignedTinyInteger('slide_group_id');

            $table->foreign('slide_group_id')
                ->references('id')
                ->on('slide_groups')
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
