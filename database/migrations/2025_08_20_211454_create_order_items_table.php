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
        Schema::create('order_items', function (Blueprint $table): void {  
            $table->id();  
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();  
            $table->string('shopify_product_id');  
            $table->string('product_name');  
            $table->integer('quantity');  
            $table->decimal('unit_price', 8, 2);  
            $table->decimal('total_price', 10, 2);  
            $table->timestamps();  
              
            $table->index(['order_id', 'shopify_product_id']);  
        });  
    }  

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
