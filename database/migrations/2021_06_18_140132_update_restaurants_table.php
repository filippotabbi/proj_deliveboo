<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('restaurants', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')
              ->nullable()
              ->after('slug');

        $table->foreign('user_id')
              ->references('id')
              ->on('users')
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
      Schema::table('restaurants', function (Blueprint $table) {
        $table->dropForeign('restaurants_user_id_foreign');
        $table->dropColumn('user_id');
      });
    }
}
