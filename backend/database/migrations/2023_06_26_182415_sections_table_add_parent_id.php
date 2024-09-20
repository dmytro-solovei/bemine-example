<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SectionsTableAddParentId extends Migration
{
    private const TABLE = 'sections';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(self::TABLE, function (Blueprint $table) {
            $table->unsignedInteger('parent_id')->after('id')->nullable();
            $table->foreign('parent_id')
                ->references('id')
                ->on(self::TABLE)
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('parent_id');
        });
    }
}
