<?php

namespace App\Http\Controllers;

use Braintree\Gateway;
use App\Order;
use App\Restaurant;
use App\Category;
use App\User;
use App\Dish;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $token = $gateway->ClientToken()->generate();

        return view('guests.orders.index', compact('token'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function orderDone()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:50',
            'customer_lastname' => 'required|string|max:50',
            'customer_email' => 'nullable|email|max:100',
            'customer_address' => 'nullable|string|max:100',
            'customer_phone_number' => 'required|string|max:20',
        ]);

        $data = $request->all();

        $dishes = json_decode(stripslashes($data["order_details"]), true);
        #region braintree
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => 'Tony',
                'lastName' => 'Stark',
                'email' => 'tony@avengers.com',
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $transaction = $result->transaction;

            //creo un novo ordine e lo fillo
            $order = new Order();
            $order->fill($data);


            $order->customer_address = $data['customer_address'];
            //mi salvo l'amount come totalpricwe nel backend
            $order->total_price = $data['amount'];


            $dish_id = $dishes[0]['id'];
            $dish = Dish::where('id', $dish_id)->get();
            $order->restaurant_id = $dish[0]->restaurant_id;

            $restaurant = Restaurant::where('id',$dish[0]->restaurant_id)->first();
            $message = 'Conferma ordine';

            //invio mail
            Mail::to($order->customer_email)->send(new SendNewMail($message,$restaurant->name,$transaction->id, $dishes,$data['amount']));

            $order->save();
            //popolazione tabella pivot
            foreach ($dishes as $dish) {
                $order->dishes()->attach($dish['id'], ['quantity' => $dish["quantity"]]);
            }

            return view('guests.orders.confirmation')->with('transaction', $transaction->id);
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors('Transazione rifiutata: ' . $result->message);
        }
        #endregion
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

}
