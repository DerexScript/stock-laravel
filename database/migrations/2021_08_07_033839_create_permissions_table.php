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
            $table->id();
            $table->boolean('view');
            $table->boolean('edit');
            $table->boolean('delete');

            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('category_id');

            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->timestamps();
        });

        /*
        DB::table('permissions')->insert([
            'user' => 'default',
            'category' => 'default',
            'view' => true,
            'edit' => true,
            'delete' => true
        ]);
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropForeign('role_id');
            $table->dropForeign('category_id');
        });
        Schema::dropIfExists('permissions');
    }
}
