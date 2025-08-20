<?php  
  
declare(strict_types=1);  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Database\Eloquent\Relations\BelongsTo;  
  
class NetProfit extends Model  
{  
    use HasFactory;  
  
    protected $table = 'net_profits_view';  
  
    protected $casts = [  
        'profit_date' => 'date',  
        'revenue' => 'decimal:2',  
        'product_costs' => 'decimal:2',  
        'ad_spend_attributed' => 'decimal:2',  
        'net_profit' => 'decimal:2',  
    ];  
  
    public function order(): BelongsTo  
    {  
        return $this->belongsTo(Order::class);  
    }  
}