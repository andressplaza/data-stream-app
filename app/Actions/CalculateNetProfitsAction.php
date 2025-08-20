<?php  
  
declare(strict_types=1);  
  
namespace App\Actions;  
  
use App\Models\Order;  
use App\Models\AdSpend;  
  
class CalculateNetProfitsAction  
{  
    public function handle(Order $order): float  
    {  
        $revenue = $order->total_amount;  
        $costs = $order->total_cost;  
          
        // Calcular gasto en publicidad atribuido  
        $adSpend = AdSpend::query()  
            ->whereDate('spend_date', $order->order_date->format('Y-m-d'))  
            ->sum('spend_amount');  
              
        $dailyOrders = Order::query()  
            ->whereDate('order_date', $order->order_date->format('Y-m-d'))  
            ->count();  
              
        $attributedAdSpend = $dailyOrders > 0 ? $adSpend / $dailyOrders : 0;  
          
        return $revenue - $costs - $attributedAdSpend;  
    }  
}