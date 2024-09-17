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
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            // Agregar la columna 'area_id' después de la columna 'id'
            $table->unsignedBigInteger('area_id')->nullable()->after('id');
            
            // Definir la llave foránea que hace referencia a la tabla 'areas'
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
        });

        Schema::table('requirements', function (Blueprint $table) {
            // Agregar la columna 'area_id' después de la columna 'id'
            $table->unsignedBigInteger('area_id')->nullable()->after('id');
            
            // Definir la llave foránea que hace referencia a la tabla 'areas'
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areas');
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['area_id']);
            $table->dropColumn('area_id');
        });
        Schema::table('requirements', function (Blueprint $table) {
            $table->dropForeign(['area_id']);
            $table->dropColumn('area_id');
        });
    }
};
