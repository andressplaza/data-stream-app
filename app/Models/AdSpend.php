<?php  
  
declare(strict_types=1);  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
  
class AdSpend extends Model  
{  
    use HasFactory;  
  
    protected $casts = [  
        'spend_date' => 'date',  
        'spend_amount' => 'decimal:2',  
    ];  
}