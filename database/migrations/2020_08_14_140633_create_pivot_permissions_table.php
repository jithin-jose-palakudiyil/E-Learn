<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_permissions', function (Blueprint $table) {
            $table->increments('id');
            
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->integer('permission_id')->unsigned();
            
            $table->foreign('user_id')->references('id')->on('admin_users')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            
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
        Schema::dropIfExists('pivot_permissions');
    }
}
