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
            $table->uuid('id')->primary();
            $table->string('name',100)->nullable();
            $table->string('contact',20)->nullable();
            $table->string('email',50)->unique();
            $table->string('user_name',30)->nullable();
            $table->string('password')->nullable();
            $table->string('user_role',50)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            //Common Columns
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->tinyInteger('status')->nullable()->default('1');
            $table->softDeletes();
            $table->timestamps();
            //Common Columns
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
