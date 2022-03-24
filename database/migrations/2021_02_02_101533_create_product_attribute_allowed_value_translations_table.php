<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributeAllowedValueTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_allowed_value_translations', function (Blueprint $table) {
            $table->unsignedBigInteger('product_attribute_allowed_value_id');
            $table->unsignedBigInteger('language_id');
            $table->string('value');

            $table->primary(['product_attribute_allowed_value_id', 'language_id']);
            $table->foreign('product_attribute_allowed_value_id')->references('id')->on('attribute_allowed_values')->onDelete('cascade')->onUpdate("cascade");
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attribute_allowed_value_translations');
    }
}
