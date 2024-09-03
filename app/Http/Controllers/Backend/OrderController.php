<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Chatorder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->get();
        $arrayStatus = Order::getArrayStatus();
        return view('admin.order.from_cart.index', compact('orders','arrayStatus'));
    }
    public function indexChatOrder()
    {
        $orders = Chatorder::latest()->get();
        $arrayStatus = Chatorder::getArrayStatus();
        return view('admin.order.from_chat.index', compact('orders','arrayStatus'));
    }
    public function getOrderInfo(Request $request){
        $orderType = $request->orderType;
        if($orderType=='cart_order'){
            $order = Order::find($request->id);
            $orderItems = OrderItem::where('order_id',$order->id)->with('product')->get();
            if($order){
                // because can not use diffForHumans in text value if whe want to do this function in view
                $response = $order->toArray();
                // do this job here instead of in view
                $response['created_at']= Carbon::parse($order->created_at)->diffForHumans();
                $response['updated_at']= Carbon::parse($order->updated_at)->diffForHumans();
                // add items to response
                // if($orderItems->count()>0){
                $response['items']= $orderItems;
                // }
                return response()->json($response);
            }
        }elseif($orderType=='chat_order'){
            $order = Chatorder::find($request->id);
            $response = $order->toArray();
            $response['created_at']= Carbon::parse($order->created_at)->diffForHumans();
            $response['updated_at']= Carbon::parse($order->updated_at)->diffForHumans();
            return response()->json($response);

        }

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajaxUpdateOrderStatus(Request $request)
    {
        $status = $request->orderStatus;
        $orderId = $request->orderId;
        $orderType = $request->orderType;
        if($orderType=='cart_order'){
            $order = Order::find( $orderId);
        }elseif($orderType=='chat_order'){
            $order = Chatorder::find( $orderId);
        }
        if($order){
            $order->status =$status;
            $order->save();
            return response()->json(['success'=>'cap nhat trang thai don hang thanh cong']);
        }
    }
    public function ajaxUpdateOrderInfors(Request $request){
        $status = $request->orderStatus;
        $orderId = $request->orderId;
        $orderType = $request->orderType;
        $adminNotes = $request->adminNotes;
        if($orderType=='cart_order'){
            $order = Order::find( $orderId);
        }elseif($orderType=='chat_order'){
            $order = Chatorder::find( $orderId);
        }
        if($order){
            $order->status =$status;
            $order->admin_notes = $adminNotes;
            $order->save();
            return response()->json(['success'=>'cap nhat don hang thanh cong']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
