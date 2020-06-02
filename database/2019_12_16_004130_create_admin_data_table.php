<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('adress');
            $table->unsignedBigInteger('id_admin')->index();
            $table->foreign('id_admin')->references('id')->on('admins')->onDelete('cascade');
            $table->string('phone');
            $table->string('about');
            $table->string('image');
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
        Schema::dropIfExists('admin_data');
        Schema::table('admins', function (Blueprint $table) {
        $table->dropColumn('id_admin');
      });
    }
}
