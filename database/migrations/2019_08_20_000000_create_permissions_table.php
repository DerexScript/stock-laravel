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
            $table->string('user');
            $table->string('category');
            $table->boolean('view');
            $table->boolean('edit');
            $table->boolean('delete');
            $table->timestamps();
        });

        DB::table('permissions')->insert([
            'user' => 'default',
            'category' => 'default',
            'view' => true,
            'edit' => true,
            'delete' => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
