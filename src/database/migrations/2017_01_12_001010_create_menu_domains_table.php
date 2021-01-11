<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_domains', function (Blueprint $table) {
            $table->increments('id')->unique()->unsigned();
            $table->enum('type', ['controller', 'action']);
            $table->string('value', 64);
            $table->integer('menu_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            //Constraints
            $table->foreign('menu_id')->references('id')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menu_domains');
    }
}
