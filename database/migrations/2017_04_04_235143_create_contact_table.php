<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table){
        	$table->increments('id');
            $table->string('title',255);
            $table->string('phone',255);
            $table->string('email',255);
            $table->text('facebook');
            $table->string('fax', 255);
            $table->text('address');
            $table->text('desc');
            $table->integer('category_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('category_id')->references('id')->on('categories');
            $table->index(['category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(Blueprint $table)
    {
        Schema::dropIfExits('contacts');
        $table->dropForeign(['category_id']);
    }
}
