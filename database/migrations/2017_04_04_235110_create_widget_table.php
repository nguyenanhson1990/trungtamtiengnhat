<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table){
        	$table->increments('id');
            $table->string('title',255);
            $table->text('script');
            $table->text('desc');
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('status')->default('0');
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->index(['user_id','status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(Blueprint $table)
    {
        Schema::dropIfExists('widgets');
        $table->dropForeign(['user_id']);
    }
}
