<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\Dish;
use Braintree\Gateway;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class OrderController extends Controller
{

  public function ordersShow($restaurant)
  {
    $orders = Order::where('restaurant_id', $restaurant)->orderBy('created_at', 'desc')->get();

    return response()->json([
      'response' => $orders,
      'success' => true,
    ]);
  }

  public function totalForMonth($restaurant)
  {
    $orders = Order::where('restaurant_id', $restaurant)->get();
    $totalForMonth = [
      "01" => 0,
      "02" => 0,
      "03" => 0,
      "04" => 0,
      "05" => 0,
      "06" => 0,
      "07" => 0,
      "08" => 0,
      "09" => 0,
      "10" => 0,
      "11" => 0,
      "12" => 0,
    ];
    $price = 0;
    foreach ($orders as $order) {
      $totalForPrice[] = $order->total_price;
      $month = date("m", strtotime($order->created_at));
      $year = date("Y", strtotime($order->created_at));

      if (date("Y") == $year) {
        foreach ($totalForMonth as $key => $element) {
          if ($month == (int)$key) {
            $totalForMonth[$key] = $totalForMonth[$key] + $order->total_price;
          }
        }
      }
    }
    foreach ($totalForMonth as $value) {
      $totalMonth[] = $value;
    }
    return response()->json([
      'response' => $totalMonth,
      'success' => true,
    ]);
  }
}
