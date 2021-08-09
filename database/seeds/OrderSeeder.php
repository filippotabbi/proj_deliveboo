<?php

use Illuminate\Database\Seeder;
use App\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = config('orders');
        foreach ($orders as $order) {
            $newOrder = new Order();
            $newOrder->customer_name = $order['customer_name'];
            $newOrder->customer_lastname = $order['customer_lastname'];
            $newOrder->customer_address = $order['customer_address'];
            $newOrder->customer_phone_number = $order['customer_phone_number'];
            $newOrder->customer_email = $order['customer_email'];
            $newOrder->total_price = $order['total_price'];
            $newOrder->order_details = $order['order_details'];
            $newOrder->restaurant_id = // e' da capire come fare;
            $newOrder->save();
        }
    }
}
