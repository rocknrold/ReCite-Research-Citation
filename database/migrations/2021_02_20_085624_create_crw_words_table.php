<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrwWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crw_words', function (Blueprint $table) {
            // $table->unsignedBigInteger('crw_search_id')->foreignId('search_id')->constrained();
            $table->unsignedBigInteger('crw_search_id')->nullable();
            $table->foreign('crw_search_id')->references('search_id')->on('crw_searches')->onDelete('cascade')->onUpdate('cascade');
            $table->string('crw_description');
            $table->string('crw_synonym');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crw_words');
    }
}
