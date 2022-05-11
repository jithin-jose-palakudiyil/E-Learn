<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivoBundlePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivo_bundle_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');;
            $table->integer('package_id')->unsigned();
            $table->integer('set_number');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->integer('question_id')->unsigned();
            $table->tinyInteger('is_negative_mark')->default('2')->comment('1-Yes, 2-No')->nullable(false);
            $table->integer('negative_mark')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pivo_bundle_packages');
    }
}
