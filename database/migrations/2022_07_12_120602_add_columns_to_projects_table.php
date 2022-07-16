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
            $table->enum("status", ['in_progress', 'pause', 'ended', 'abort'])->nullable();
            $table->boolean("is_opensource")->default(false);
            $table->string("site_url", 100)->nullable();
            $table->string("repository_url", 100)->nullable();
            $table->foreignId('type_id')->default(null)->nullable()->constrained('project_types');
            $table->foreignId('deliverable_id')->default(null)->nullable()->constrained('project_deliverables');
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
            $table->dropColumn('status');
            $table->dropColumn('is_opensource');
            $table->dropColumn('site_url');
            $table->dropColumn('repository_url');
            $table->dropForeign('projects_type_id_foreign');
            $table->dropForeign('projects_deliverable_id_foreign');
            $table->dropColumn('type_id');
            $table->dropColumn('deliverable_id');
        });
    }
};
