<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->string('author', 255);
            $table->string('edition', 255);
            $table->text('description');
            $table->integer('cover_type_id');
            $table->integer('year_edition');
            $table->integer('deal_type_id');
            $table->integer('rent_amount');
            $table->integer('rent_type_id');
            $table->integer('page_count');
            $table->integer('price');
            $table->integer('user_id');
            $table->tinyInteger('status');
            $table->tinyInteger('moderation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
