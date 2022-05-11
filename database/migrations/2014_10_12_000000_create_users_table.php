<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('mobile')->nullable(false);
            $table->string('email')->nullable(false);
            $table->string('password')->nullable(false);
            $table->text('profile_image')->nullable();
            $table->text('bio')->nullable();
            $table->string('otp',255)->collation('utf8mb4_unicode_ci')->nullable();
            $table->timestamp('otp_created_at')->nullable();
            $table->tinyInteger('receiving_emails')->default(0)->comment('0-no, 1-yes');
            $table->tinyInteger('is_agree')->default(0)->comment('0-no, 1-yes');
            $table->tinyInteger('email_verified')->default(0)->comment('0-no, 1-yes');
            $table->timestamp('email_verified_at')->nullable(); 
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
