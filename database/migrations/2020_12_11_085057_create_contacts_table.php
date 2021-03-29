<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('zip')->nullable();
            $table->string('is_manufacturer')->nullable();
            $table->string('type')->nullable();
            $table->string('is_packager')->nullable();
            $table->string('address')->nullable();
            $table->string('state')->nullable();
            $table->string('is_distributor')->nullable();
            $table->string('city')->nullable();
            $table->string('is_reseller')->nullable();
            $table->string('is_other')->nullable();
            $table->string('name')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
