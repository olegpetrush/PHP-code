<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('outer_packaging')->nullable();
            $table->text('statement_of_identity')->nullable();
            $table->string('langual_dietary_claim_or_use')->nullable();
            $table->unsignedInteger('count')->nullable();
            $table->string('product_name')->nullable();
            $table->string('langual_product_type')->nullable();
            $table->string('brand')->nullable();
            $table->string('date_entered_into_dsld')->nullable();
            $table->text('serving_size')->nullable();
            $table->string('nhanes_id')->nullable();
            $table->boolean('success')->unsigned();
            $table->text('suggested_use')->nullable();
            $table->string('database')->nullable();
            $table->string('net_contents_quantity')->nullable();
            $table->string('langual_supplement_form')->nullable();
            $table->string('product_trademark_copyright_symbol')->nullable();
            $table->string('sku')->nullable();
            $table->string('db_source')->nullable();
            $table->string('langual_intended_target_groups')->nullable();
            $table->string('tracking_history');
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
        Schema::dropIfExists('products');
    }
}
