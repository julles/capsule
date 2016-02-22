<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id');
            $table->string('username')->index();
            $table->string('password');
            $table->string('name');
            $table->string('email')->index();
            $table->string('avatar');
            $table->enum('status',['y','n']);
            $table->timestamps();
        
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        \DB::table('users')->insert([
            'role_id'   => App\Models\Role::find(1)->id,
            'username'  => 'reza',
            'name'      => 'Muhamad Reza AR',
            'email'     => 'reza.wikrama3@gmail.com',
            'status'    => 'y',
            'password'  => \Hash::make('reza'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
