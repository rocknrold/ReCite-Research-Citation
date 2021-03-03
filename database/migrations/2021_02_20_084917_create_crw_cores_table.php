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
            $table->year('core_yearPublished');
            $table->longText('core_description');
            $table->string('core_oai');
            $table->string('core_downloadUrl');
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
