<?php  
  
declare(strict_types=1);  
  
namespace Database\Factories;  
  
use App\Models\AdSpend;  
use Illuminate\Database\Eloquent\Factories\Factory;  
  
class AdSpendFactory extends Factory  
{  
    protected $model = AdSpend::class;  
  
    public function definition(): array  
    {  
        $impressions = $this->faker->numberBetween(1000, 50000);  
        $clicks = $this->faker->numberBetween(10, (int)($impressions * 0.05));  
        $conversions = $this->faker->numberBetween(0, (int)($clicks * 0.1));  
          
        return [  
            'facebook_campaign_id' => $this->faker->numerify('camp_####'),  
            'campaign_name' => $this->faker->words(3, true),  
            'ad_set_id' => $this->faker->optional()->numerify('adset_####'),  
            'ad_id' => $this->faker->optional()->numerify('ad_####'),  
            'spend_amount' => $this->faker->randomFloat(2, 10, 1000),  
            'impressions' => $impressions,  
            'clicks' => $clicks,  
            'conversions' => $conversions,  
            'spend_date' => $this->faker->dateTimeBetween('-30 days', 'now'),  
        ];  
    }  
  
    public function highPerformance(): self  
    {  
        return $this->state(fn (array $attributes): array => [  
            'clicks' => (int)($attributes['impressions'] * 0.08),  
            'conversions' => (int)($attributes['clicks'] * 0.15),  
        ]);  
    }  
}