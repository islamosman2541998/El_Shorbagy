<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('slider_translations', function (Blueprint $table) {
            $table->text('sub_desc1')->nullable()->after('description');
            $table->text('sub_desc2')->nullable()->after('sub_desc1');
        });
    }

    public function down(): void
    {
        Schema::table('slider_translations', function (Blueprint $table) {
            $table->dropColumn(['sub_desc1', 'sub_desc2']);
        });
    }
};