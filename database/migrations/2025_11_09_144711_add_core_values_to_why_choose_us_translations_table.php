<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoreValuesToWhyChooseUsTranslationsTable extends Migration
{
    public function up()
    {
        Schema::table('why_choose_us_translations', function (Blueprint $table) {
            $table->json('core_values')->nullable()->after('at_a_glance');
        });
    }

    public function down()
    {
        Schema::table('why_choose_us_translations', function (Blueprint $table) {
            if (Schema::hasColumn('why_choose_us_translations', 'core_values')) {
                $table->dropColumn('core_values');
            }
        });
    }
}
