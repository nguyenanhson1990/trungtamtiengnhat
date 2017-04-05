<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function(Blueprint $table){
        	$table->increments('id');
            $table->string('title',255);
            $table->text('content');
            $table->text('short_content');
            $table->tinyInteger('content_type');
            $table->dateTime('end_date');
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->tinyInteger('status')->default('0');
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(Blueprint $table)
    {
        Schema::dropIfExists('contents');
        $table->dropForeign(['user_id','category_id']);
    }
}
