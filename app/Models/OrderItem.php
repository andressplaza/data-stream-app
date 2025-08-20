<?php  
  
declare(strict_types=1);  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Database\Eloquent\Relations\BelongsTo;  
  
class OrderItem extends Model  
{  
    use HasFactory;  
  
    protected $casts = [  
        'unit_price' => 'decimal:2',  
        'total_price' => 'decimal:2',  
    ];  
  
    public function order(): BelongsTo  
    {  
        return $this->belongsTo(Order::class);  
    }  
}