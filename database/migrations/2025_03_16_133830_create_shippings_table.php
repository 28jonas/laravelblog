<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_number', 20)->nullable();
            $table->string('carrier', 20)->nullable();
            $table->string('status', 20)->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->dateTime('shipping_date')->nullable();
            $table->string('shipping_method', 20)->nullable();
            $table->decimal('shipping_cost', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
