<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('ingredient_id');
            $table->foreignId('product_id')->constrained('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('dsld_ingredient_categories')->nullable();
            $table->string('amount_serving_unit')->nullable();
            $table->unsignedInteger('ingredient_group_grp_id')->nullable();
            $table->text('blends')->nullable();
            $table->string('amount_per_serving')->nullable();
            $table->text('dietary_ingredient_synonym_source')->nullable();
            $table->string('blended_ingredient_types')->nullable();
            $table->string('pct_daily_value_per_serving')->nullable();
            $table->string('serving_size')->nullable();
            $table->text('suggested_recommended_usage_directions')->nullable();
            $table->string('db_source')->nullable();
            $table->text('ancestry_number_of_parents_row_ids')->nullable();
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
        Schema::dropIfExists('ingredients');
    }
}
