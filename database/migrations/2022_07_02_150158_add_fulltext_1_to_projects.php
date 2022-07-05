<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->fullText("name");
            $table->fullText(["name","summary"]);
            $table->fullText(["name","summary","description"]);
            $table->fullText('summary');
            $table->fullText('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropFullText('projects_name_fulltext');
            $table->dropFullText('projects_summary_fulltext');
            $table->dropFullText('projects_description_fulltext');
            $table->dropFullText('projects_name_summary_fulltext');
            $table->dropFullText('projects_name_summary_description_fulltext');
        });
    }
};
