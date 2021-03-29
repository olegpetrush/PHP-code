<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrecautionsDirectionsFormulationsDescriptionsColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('precautions')->nullable()->after('tracking_history');
            $table->text('directions')->nullable()->after('precautions');
            $table->text('formulations')->nullable()->after('directions');
            $table->text('description')->nullable()->after('formulations');
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
            $table->dropColumn(['precautions','directions','formulations','description']);
        });
    }
}
