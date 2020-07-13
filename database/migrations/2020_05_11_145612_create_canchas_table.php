<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanchasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canchas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('url')->unique()->nullable();
            $table->float('precio')->nullable();
            $table->text('descripcion')->nullable(); 
            $table->mediumText('iframe')->nullable();          
            $table->unsignedInteger('estado_id')->nullable();
            $table->string('color')->nullable();
            $table->bigInteger('total_visitas')->nullable();
            

            $table->unsignedBigInteger('complejo_id')->nullable();
            $table->foreign('complejo_id')->references('id')->on('complejos')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 

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
        Schema::dropIfExists('canchas');
    }
}
