<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    $database = env('DB_DATABASE');

    $fk = DB::selectOne("
        SELECT CONSTRAINT_NAME as name
        FROM information_schema.KEY_COLUMN_USAGE
        WHERE TABLE_SCHEMA = ?
          AND TABLE_NAME = ?
          AND COLUMN_NAME = ?
          AND REFERENCED_TABLE_NAME IS NOT NULL
        LIMIT 1
    ", [$database, 'projects', 'portfolio_id']);

    if ($fk && isset($fk->name)) {
        Schema::table('projects', function (Blueprint $table) use ($fk) {
            $table->dropForeign($fk->name);
        });
    }

    if (Schema::hasColumn('projects', 'portfolio_id')) {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('portfolio_id');
        });
    }
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('projects', function (Blueprint $table) {
        
        });
    }
};
