<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsActivationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins_activations', function (Blueprint $table) {
            $table->increments('id');
        $table->unsignedBigInteger('id_user')->index();
        $table->foreign('id_user')->references('id')->on('admins')->onDelete('cascade');
        $table->string('token');
        $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      });

      Schema::table('admins', function (Blueprint $table) {
          $table->boolean('is_activated')->default(0);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop("admins_activations");
      Schema::table('admins', function (Blueprint $table) {
        $table->dropColumn('is_activated');
      });
    }
}