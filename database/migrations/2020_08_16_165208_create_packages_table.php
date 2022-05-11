<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('category_id')->references('id')->on('question_category')->onDelete('cascade');;
            $table->integer('category_id')->unsigned();
            $table->tinyInteger('status')->default('2')->comment('1-Active, 2-Disable')->nullable(false);
            $table->integer('sets');
            $table->integer('questions_in_set');
            $table->integer('validity');
            $table->string('name');
            $table->string('price');
            $table->string('package_image'); 
            $table->tinyInteger('is_offer')->default('2')->comment('1-Yes, 2-No')->nullable(false);
            $table->string('offer_price')->nullable();
            $table->tinyInteger('is_publish')->default('2')->comment('1-published, 2-not published')->nullable(false);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
