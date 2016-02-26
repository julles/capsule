<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('parent_id')->index();
            $table->string('title',50);
            $table->string('permalink',50)->index();
            $table->string('icon',50);
            $table->string('controller',50)->index();
            $table->integer('order');
            $table->timestamps();
        });

        //\DB::unprepared(file_get_contents(database_path('menus_seeds.sql')));
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
