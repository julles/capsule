<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->index();
            $table->string('label');
            $table->timestamps();
        });

        \DB::table('actions')->insert([
            'code' => 'index',
            'label' => 'Index',
        ]);

        \DB::table('actions')->insert([
            'code' => 'create',
            'label' => 'Create',
        ]);

        \DB::table('actions')->insert([
            'code' => 'update',
            'label' => 'Update',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('actions');
    }
}
