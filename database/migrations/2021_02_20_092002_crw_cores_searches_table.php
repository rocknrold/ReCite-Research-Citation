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
            $table->unsignedBigInteger('crw_coresID')->foreignId('core_id')->constrained();
            $table->unsignedBigInteger('crw_searchesID')->foreignId('search_id')->constrained();
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
