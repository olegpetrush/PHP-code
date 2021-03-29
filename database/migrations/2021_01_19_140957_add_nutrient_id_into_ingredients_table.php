<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNutrientIdIntoIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ingredients', function (Blueprint $table) {
            $table->foreignId('nutrient_id')->nullable()->after('dietary_ingredient_synonym_source')
                ->constrained('nutrients')
                ->cascadeOnUpdate()
                ->onDelete('restrict');
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
            $table->dropForeign('ingredients_nutrient_id_foreign');
            $table->dropColumn('nutrient_id');
        });
    }
}
