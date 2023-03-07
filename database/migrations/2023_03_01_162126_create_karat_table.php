<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karat', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->uuid('category_id')->nullable();

            $table->string('description')->nullable();
            

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
        Schema::dropIfExists('karat');
    }
}
