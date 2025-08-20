<?php  
  
declare(strict_types=1);  
  
namespace Database\Factories;  
  
use App\Models\NetProfit;  
use App\Models\Order;  
use Illuminate\Database\Eloquent\Factories\Factory;  
  
class NetProfitFactory extends Factory  
{  
    protected $model = NetProfit::class;  
  
    public function definition(): array  
    {  
        $revenue = $this->faker->randomFloat(2, 50, 1000);  
        $productCosts = $this->faker->randomFloat(2, 10, $revenue * 0.6);  
        $adSpend = $this->faker->randomFloat(2, 5, $revenue * 0.3);  
          
        return [  
            'order_id' => Order::factory(),  
            'shopify_order_id' => $this->faker->unique()->numerify('####'),  
            'order_number' => $this->faker->unique()->numerify('ORD-####'),  
            'revenue' => $revenue,  
            'product_costs' => $productCosts,  
            'ad_spend_attributed' => $adSpend,  
            'net_profit' => $revenue - $productCosts - $adSpend,  
            'profit_date' => $this->faker->dateTimeBetween('-30 days', 'now'),  
            'currency' => 'EUR',  
        ];  
    }  
}