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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->integer('stock');
            $table->decimal('cost_price', $precision = 10, $scale = 2);
            $table->decimal('unit_price', $precision = 10, $scale = 2);
            $table->string('image')->nullable();
            $table->foreignId('category_id')->constrained();
            $table->timestamps();

            $table->index('stock');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
