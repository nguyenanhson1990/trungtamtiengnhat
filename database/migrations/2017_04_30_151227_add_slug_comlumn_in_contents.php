<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugComlumnInContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contents',function(Blueprint $table){
            $table->string('thumbnail')->nullable()->change();
            $table->text('og_desc')->nullable()->change();
            $table->string('og_keyword')->nullable()->change();
            $table->text('content')->nullable()->change();
            $table->text('short_content')->nullable()->change();
            $table->dateTime('end_date')->nullable()->change();
            $table->string('slug')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(Blueprint $table)
    {
        $table->string('thumbnail')->nullable(false)->change();
        $table->text('og_desc')->nullable(false)->change();
        $table->string('og_keyword')->nullable(false)->change();
        $table->text('content')->nullable(false)->change();
        $table->text('short_content')->nullable(false)->change();
        $table->dateTime('end_date')->nullable(false)->change();
        $table->dropColumn('slug');
    }
}
