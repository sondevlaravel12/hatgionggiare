<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Cart::content()->count()<1){
            return redirect()->back()->withErrors(['message' =>'Giỏ hàng không có sản phẩm, vui lòng đặt hàng lại']);
        }
        //validate
        $validated = $request->validate([
            'username' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'dongychinhsach' => 'required',

        ]);
        $order = $this->storeOrderDetails($request);
        if($order){
            return redirect()->route('order.thankyou', $order);
        }else{
            return redirect()->back()->withErrors(['message' =>'dat hang that bai']);
        }


    }
    public function thankyou(Order $order){
        // if(!$order || Cart::content()->count()<1) return redirect()->back()->with('message','Không có sản phẩm trong giỏ hàng. Quý khách vui lòng đặt hàng lại');
        $orderItems = $order->items;
        // dd($orderItems);
        Cart::destroy();
        return view('cart.thankyou', compact('order','orderItems'));
        // dd('hi');

    }
    public function storeOrderDetails(Request $request){
        // dd((string)Cart::total());
        $order = Order::create([
            'order_number'      =>  'ORD-'.strtoupper(uniqid()),
            //'user_id'           => auth()->user()->id,
            'status'            =>  'pending',
            'total'             =>  str_replace('.', '', Cart::total()),
            'item_count'        =>  Cart::count(),
            'payment_status'    =>  0,
            'payment_method'    =>  null,
            'client_name'        =>  $request['username'],
            'address'           =>  $request['address'],
            'phone_number'      =>  $request['phone'],
            'notes'             =>  $request['note'],
            'email'             =>  $request['email']
        ]);
        if ($order) {

            $items = Cart::content();

            foreach ($items as $item)
            {
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                $product = $item->model;

                $orderItem = new OrderItem([
                    'product_id'    =>  $product->id,
                    'quantity'      =>  $item->quantity,
                    'price'         =>  $item->price,
                    'quantity'      =>  $item->qty,
                ]);

                $order->items()->save($orderItem);
            }
        }

        return $order;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
