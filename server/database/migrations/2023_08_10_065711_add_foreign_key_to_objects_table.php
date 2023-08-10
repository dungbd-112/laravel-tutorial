<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objects', function (Blueprint $table) {
            if(Schema::hasColumn('objects', 'sentence_id'))
                $table->foreign('sentence_id')->references('id')->on('sentences')->onDelete('cascade');
            if(Schema::hasColumn('objects', 'page_id'))
                $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('objects', function (Blueprint $table) {
            if(Schema::hasColumn('objects', 'sentence_id'))
                $table->dropForeign(['sentence_id']);
            if(Schema::hasColumn('objects', 'page_id'))
                $table->dropForeign(['page_id']);
        });
    }
}