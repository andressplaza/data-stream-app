<?php  
  
declare(strict_types=1);  
  
namespace Database\Factories;  
  
use App\Models\Order;  
use App\Models\OrderItem;  
use Illuminate\Database\Eloquent\Factories\Factory;  
  
class OrderItemFactory extends Factory  
{  
    protected $model = OrderItem::class;  
  
    public function definition(): array  
    {  
        $unitPrice = $this->faker->randomFloat(2, 10, 200);  
        $quantity = $this->faker->numberBetween(1, 5);  
          
        return [  
            'order_id' => Order::factory(),  
            'shopify_product_id' => $this->faker->numerify('prod_####'),  
            'product_name' => $this->faker->words(2, true),  
            'quantity' => $quantity,  
            'unit_price' => $unitPrice,  
            'total_price' => $unitPrice * $quantity,  
        ];  
    }  
}