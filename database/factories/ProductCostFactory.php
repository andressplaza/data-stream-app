<?php  
  
declare(strict_types=1);  
  
namespace Database\Factories;  
  
use App\Models\ProductCost;  
use Illuminate\Database\Eloquent\Factories\Factory;  
  
class ProductCostFactory extends Factory  
{  
    protected $model = ProductCost::class;  
  
    public function definition(): array  
    {  
        return [  
            'shopify_product_id' => $this->faker->unique()->numerify('prod_####'),  
            'product_name' => $this->faker->words(3, true),  
            'cost_per_unit' => $this->faker->randomFloat(2, 5, 100),  
            'effective_from' => $this->faker->dateTimeBetween('-1 year', 'now'),  
            'effective_to' => null,  
        ];  
    }  
  
    public function expired(): self  
    {  
        return $this->state(fn (array $attributes): array => [  
            'effective_to' => $this->faker->dateTimeBetween($attributes['effective_from'], 'now'),  
        ]);  
    }  
}