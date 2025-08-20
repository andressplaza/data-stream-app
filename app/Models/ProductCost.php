<?php  
  
declare(strict_types=1);  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
  
class ProductCost extends Model  
{  
    use HasFactory;  
  
    protected $casts = [  
        'effective_from' => 'date',  
        'effective_to' => 'date',  
        'cost_per_unit' => 'decimal:2',  
    ];  
}