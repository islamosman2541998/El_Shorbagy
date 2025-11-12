<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhyChooseUsTable extends Migration
{
    public function up()
    {
        Schema::create('why_choose_us', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();              
            $table->string('image_background')->nullable();    
            $table->boolean('status')->default(true);
            $table->integer('sort')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('why_choose_us');
    }
}
