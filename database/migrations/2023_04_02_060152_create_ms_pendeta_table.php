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
        Schema::create('ms_pendeta', function (Blueprint $table) {
            $table->id();
            $table->string('id_user')->nullable();
            $table->string('nama');
            $table->string('alamat');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('no_telp');
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
        Schema::dropIfExists('ms_pendeta');
    }
};
