<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrwCoreCitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crw_core_citations', function (Blueprint $table) {
            $table->id('crw_citationID');
            $table->unsignedBigInteger('crw_coresID');
            $table->foreign('crw_coresID')->references('core_id')->on('crw_cores')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('crw_citation_count');
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
        Schema::dropIfExists('crw_core_citations');
    }
}
