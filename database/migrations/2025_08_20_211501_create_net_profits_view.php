<?php  
  
declare(strict_types=1);  
  
use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
return new class extends Migration  
{  
    public function up(): void  
    {  
        Schema::create('net_profits_view', function (Blueprint $table): void {  
            $table->id();  
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();  
            $table->string('shopify_order_id');  
            $table->string('order_number');  
            $table->decimal('revenue', 10, 2);  
            $table->decimal('product_costs', 10, 2);  
            $table->decimal('ad_spend_attributed', 10, 2);  
            $table->decimal('net_profit', 10, 2);  
            $table->date('profit_date');  
            $table->string('currency', 3)->default('EUR');  
            $table->timestamps();  
              
            $table->index(['profit_date', 'net_profit']);  
            $table->index('order_id');  
        });  
    }  
  
    public function down(): void  
    {  
        Schema::dropIfExists('net_profits_view');  
    }  
};