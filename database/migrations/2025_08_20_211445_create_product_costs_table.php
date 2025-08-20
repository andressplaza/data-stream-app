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
        Schema::create('product_costs', function (Blueprint $table): void {  
            $table->id();  
            $table->string('shopify_product_id');  
            $table->string('product_name');  
            $table->decimal('cost_per_unit', 8, 2);  
            $table->date('effective_from');  
            $table->date('effective_to')->nullable();  
            $table->timestamps();  
              
            $table->index(['shopify_product_id', 'effective_from']);  
        });  
    }  

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_costs');
    }
};
