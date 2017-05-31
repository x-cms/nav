<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavNodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nav_nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nav_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('related_id')->unsigned()->nullable();
            $table->string('type');
            $table->string('url')->nullable();
            $table->string('title')->nullable();
            $table->string('icon_font')->nullable();
            $table->string('css_class')->nullable();
            $table->string('target')->nullable();
            $table->integer('order')->unsigned()->default(0);

            $table->foreign('nav_id')->references('id')->on('navs')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('nav_nodes')->onDelete('set null');

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
        Schema::dropIfExists('nav_nodes');
    }
}
