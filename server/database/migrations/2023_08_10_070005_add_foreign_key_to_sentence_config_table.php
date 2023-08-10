<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToSentenceConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sentence_config', function (Blueprint $table) {
            if(Schema::hasColumn('sentence_config', 'sentence_id'))
                $table->foreign('sentence_id')->references('id')->on('sentences')->onDelete('cascade');
            if(Schema::hasColumn('sentence_config', 'page_id'))
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
        Schema::table('sentence_config', function (Blueprint $table) {
            if(Schema::hasColumn('sentence_config', 'sentence_id'))
                $table->dropForeign(['sentence_id']);
            if(Schema::hasColumn('sentence_config', 'page_id'))
                $table->dropForeign(['page_id']);
        });
    }
}