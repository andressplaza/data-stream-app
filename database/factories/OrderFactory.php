<?php  
  
declare(strict_types=1);  
  
namespace Database\Factories;  
  
use App\Models\Order;  
use Illuminate\Database\Eloquent\Factories\Factory;  
  
class OrderFactory extends Factory  
{  
    protected $model = Order::class;  
  
    public function definition(): array  
    {  
        return [  
            'shopify_order_id' => $this->faker->unique()->numerify('####'),  
            'order_number' => $this->faker->unique()->numerify('ORD-####'),  
            'customer_email' => $this->faker->email(),  
            'total_amount' => $this->faker->randomFloat(2, 10, 500),  
            'currency' => 'EUR',  
            'order_date' => $this->faker->dateTimeBetween('-30 days', 'now'),  
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),  
        ];  
    }  
}