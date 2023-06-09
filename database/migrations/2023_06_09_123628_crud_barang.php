<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('crudBarang', function (Blueprint $table) {
            $table->increments('id_produk');
            $table->string('nama_produk');
            $table->string('kategori');
            $table->integer("harga");
            $table->integer("no");
            $table->string("status");
        });
    }

    public function down()
    {
        Schema::dropIfExists('table_name');
    }

};
