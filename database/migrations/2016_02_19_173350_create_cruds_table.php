<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Faker\Factory;

class CreateCrudsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cruds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('company');
            $table->enum('gender',['men','woman']);
            $table->string('photo');
            $table->timestamps();

        });

        $faker = Factory::create();

        $limit = 10;

        for($i=0;$i<$limit;$i++)
        {
            \DB::table('cruds')->insert([
                'name'      => $faker->name,
                'company'   => $faker->company,
                'gender'    => $faker->randomElement(['men','woman']),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cruds');
    }
}
