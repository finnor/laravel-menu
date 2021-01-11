<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id')->unique()->unsigned();
            $table->string('name', 64);
            $table->string('action', 64)->nullable();
            $table->string('icon', 64)->nullable();
            $table->integer('menu_parent_id')->unsigned()->nullable();
            $table->tinyInteger('order')->nullable();
            $table->softDeletes();
            $table->timestamps();

            //Constraints
            $table->foreign('menu_parent_id')->references('id')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menus');
    }
}
