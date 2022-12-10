<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',60);
            $table->string('sku',60)->unique();
            $table->string('valor',60);
            $table->string('imagen',254);
            $table->integer('estado')->default(1);
            $table->unsignedBigInteger('tienda');
            $table->foreign('tienda')->references('id')->on('tienda');
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
        Schema::dropIfExists('producto');
    }
};
