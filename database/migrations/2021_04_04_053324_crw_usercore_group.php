<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrwUsercoreGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW crw_usercore_views AS 
            SELECT core.core_id as core_id, 
                (SELECT users.name FROM users WHERE core.user_id = users.id) as username, 
                (SELECT users.id FROM users WHERE core.user_id = users.id) as user_id, 
                core.core_title, core.core_yearPublished, core.core_downloadUrl, 
                core.likes, core.dislikes, core.visibility ,core.core_description, 
                citation.crw_citation_count 
            FROM crw_cores core 
            INNER JOIN crw_core_citations citation ON core.core_id = citation.crw_coresID
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW crw_usercore_view;");
    }
}
