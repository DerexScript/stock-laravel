<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('category_id');
            $table->boolean('view');
            $table->boolean('edit');
            $table->boolean('delete');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
            $table->primary(['role_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropForeign('permissions_role_id_foreign');
            $table->dropForeign('permissions_category_id_foreign');
        });
        Schema::dropIfExists('permissions');
    }
}
