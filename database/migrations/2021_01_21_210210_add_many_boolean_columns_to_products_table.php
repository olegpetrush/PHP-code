<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddManyBooleanColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('artificial_flavor')->unsigned()->default(1);
            $table->boolean('artificial_color')->unsigned()->default(1);
            $table->boolean('preservatives')->unsigned()->default(1);
            $table->boolean('sugar')->unsigned()->default(1);
            $table->boolean('starch')->unsigned()->default(1);
            $table->boolean('milk')->unsigned()->default(1);
            $table->boolean('lactose')->unsigned()->default(1);
            $table->boolean('yeast')->unsigned()->default(1);
            $table->boolean('fish')->unsigned()->default(1);
            $table->boolean('sodium')->unsigned()->default(1);
            $table->boolean('soy')->unsigned()->default(1);
            $table->boolean('gluten')->unsigned()->default(1);
            $table->boolean('wheat')->unsigned()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'artificial_flavor',
                'artificial_color',
                'preservatives',
                'sugar',
                'starch',
                'milk',
                'lactose',
                'yeast',
                'fish',
                'sodium',
                'soy',
                'gluten',
                'wheat'
            ]);
        });
    }
}
