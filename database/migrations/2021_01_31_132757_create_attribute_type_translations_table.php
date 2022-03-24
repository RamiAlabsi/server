<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_type_translations', function (Blueprint $table) {
            $table->string('name');

            $table->unsignedBigInteger('attribute_type_id');
            $table->unsignedBigInteger('language_id');

            $table->unique(['attribute_type_id', 'language_id']);
            $table->foreign('attribute_type_id')->references('id')->on('attribute_types');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_type_translations');
    }
}
