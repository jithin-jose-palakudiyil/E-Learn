<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('questions_id')->references('id')->on('questions')->onDelete('cascade');
            $table->integer('questions_id')->unsigned();
            $table->string('answer');
            $table->tinyInteger('is_correct')->default('2')->comment('1-Yes, 2-No')->nullable(false);
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
        Schema::dropIfExists('pivot_questions');
    }
}
