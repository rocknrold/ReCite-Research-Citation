<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrwCoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crw_cores', function (Blueprint $table) {
            $table->id('core_id');
            $table->string('core_title');
            $table->year('core_yearPublished')->nullable();
            $table->longText('core_description')->nullable();
            $table->string('core_doi')->nullable();
            $table->string('core_downloadUrl')->nullable();
            $table->integer('likes');
            $table->integer('dislikes');
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
        Schema::dropIfExists('crw_cores');
    }
}
