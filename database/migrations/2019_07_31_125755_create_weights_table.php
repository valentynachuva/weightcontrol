<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weights', function (Blueprint $table) {
            
        $table->bigIncrements('id');
        $table->bigInteger('user_id')->unsigned();// при создании внешнего ключа,
        // указывающего на автоматическое числовое поле,делаем указывающее поле 
        // (поле внешнего ключа) 
        // типа UNSIGNED.
            $table->Integer('value');
            $table->text('remark')->nullable(true);
            $table->timestamps();
        });
         Schema::table('weights', function (Blueprint $table) {
         //связываем пользователя с его данными внешним ключом    
        $table->foreign('user_id')->references('id')->on('users');
         });
        //удаляя пользователя, удаляется вся инфа, которая с ним связана
        Schema::table('weights', function (Blueprint $table){
        $table->foreign('user_id')->references('id')->on('users')
         ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('weights');
           //
    }
}
