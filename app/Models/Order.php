<?php  
  
declare(strict_types=1);  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Database\Eloquent\Relations\HasMany;  
  
class Order extends Model  
{  
    use HasFactory;  
  
    protected $casts = [  
        'order_date' => 'datetime',  
        'total_amount' => 'decimal:2',  
    ];  
  
    public function orderItems(): HasMany  
    {  
        return $this->hasMany(OrderItem::class);  
    }  
  
    public function getTotalCostAttribute(): float  
    {  
        return $this->orderItems->sum(function (OrderItem $item): float {  
            $productCost = ProductCost::query()  
                ->where('shopify_product_id', $item->shopify_product_id)  
                ->where('effective_from', '<=', $this->order_date)  
                ->where(function ($query): void {  
                    $query->whereNull('effective_to')  
                        ->orWhere('effective_to', '>=', $this->order_date);  
                })  
                ->first();  
  
            return $productCost ? $productCost->cost_per_unit * $item->quantity : 0;  
        });  
    }  
}