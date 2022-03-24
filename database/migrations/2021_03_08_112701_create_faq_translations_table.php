<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_translations', function (Blueprint $table) {
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('faq_id');
            $table->primary(['language_id', 'faq_id']);
            
            $table->text('question');
            $table->longText('answer');
            
            $table->foreign("language_id")->references("id")->on("languages")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("faq_id")->references("id")->on("faq")->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_translations');
    }
}
