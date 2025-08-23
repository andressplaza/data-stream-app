<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;

    public int $id;
    public string $shopify_order_id;
    public string $order_number;
    public string $customer_email;
    public float $total_amount;
    public string $currency;
    public Carbon $order_date;
    public string $status;
    public ?Carbon $created_at;
    public ?Carbon $updated_at;

    // Casts
    protected $casts = [
        'order_date' => 'datetime',
        'total_amount' => 'decimal:2',
    ];

    // Relaciones
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
