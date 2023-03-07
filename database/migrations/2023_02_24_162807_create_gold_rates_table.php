<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoldRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gold_rates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('sheet_id')->nullable();
            $table->uuid('category_id')->nullable();
            $table->integer('market')->nullable();
            $table->integer('sell')->nullable();
            $table->integer('buy')->nullable();
            //Common Columns
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->tinyInteger('status')->nullable()->default('1');
            $table->softDeletes();
            $table->timestamps();
            //Common Colum
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gold_rates');
    }
}
