<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableIngredientsAddNewAmountPerServingNewAmountServingUnit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingredients', function (Blueprint $table) {
            $table->string('new_amount_serving_unit')->after('amount_serving_unit')->nullable();
            $table->string('new_amount_per_serving')->after('amount_per_serving')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingredients', function (Blueprint $table) {
            $table->dropColumn(['new_amount_serving_unit','new_amount_per_serving']);
        });
    }
}
