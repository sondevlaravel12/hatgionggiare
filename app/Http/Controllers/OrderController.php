<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Webinfo;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
// use Illuminate\Contracts\Session\Session;

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
        $validated = $request->validate(
            [
            'username' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'dongychinhsach' => 'required',

            ],
            [
                'username.required'=>'Họ tên không được để trống',
                'phone.required'=>'Số điện thoại không được để trống',
                'address.required'=>'Địa chỉ nhận hàng không được để trống',
                'dongychinhsach.required'=>'Bạn cần đồng ý với các chính sách và quy định mua hàng tại website',
            ]
        );
        $order = $this->storeOrderDetails($request);
        if($order){
            session()->flash('order_status','successful');
            return redirect()->route('order.thankyou', $order);
        }else{
            return redirect()->back()->withErrors([
                'message' =>'dat hang that bai',
                'alert-type'=>'error'
            ]);
        }


    }
    public function thankyou(Order $order){
        // if(session('order_status')=='successful'){
            $shipping_fee = Webinfo::first()->shipping_fee;
            // $total =$order->total + $shipping_fee;
            $totalPrice = $order->getRawOriginal('total') + $order->discount;
            $totalPrice = number_format($totalPrice,0,',','.');
            $total =$order->getRawOriginal('total')+ $shipping_fee;
            $shipping_fee = number_format($shipping_fee,0,',','.');
            $total = number_format($total,0,',','.');
            $orderItems = $order->items;
            Cart::destroy();
            return view('cart.thankyou', compact('order','orderItems','shipping_fee','total','totalPrice'));
        // }else{
        //     return redirect()->route('home')->with([
        //         'message'=>'Bạn không có quyền truy cập trang này',
        //         'alert-type'=>'error'
        //     ]);
        // }


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
            'email'             =>  $request['email'],
            // 'discount'          => Cart::discount()
            'discount'          => str_replace('.', '', Cart::discount()),
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
