<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrwCoresSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crw_cores_searches', function(Blueprint $table){
            $table->unsignedBigInteger('crw_coresID')->nullable();
            $table->foreign('crw_coresID')->references('core_id')->on('crw_cores')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('crw_searchesID')->nullable();
            $table->foreign('crw_searchesID')->references('search_id')->on('crw_searches')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropdropIfExists('crw_core_searches');
    }
}
