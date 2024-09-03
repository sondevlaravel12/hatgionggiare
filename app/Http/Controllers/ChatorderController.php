<?php

namespace App\Http\Controllers;

use App\Models\Chatorder;
use Illuminate\Http\Request;

class ChatorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'urltrangweb' => 'required',
            'client_name' => 'required|min:3|max:100',
            'phone_number'=>'nullable|min:5|max:15',
            'address'=>'required|min:5|max:150',
            'product'=>'required|min:5|max:1550'
        ]);
        $input = [
            'urltrangweb' => $request->urltrangweb,
            'client_name' => $request->client_name,
            'phone_number'=>$request->phone_number,
            'address'=>$request->address,
            'product'=>$request->product,
        ];
        if(Chatorder::create($input)){
            return response()->json(['success'=>'Bạn đã đặt hàng thành công!']);
        }
        return response()->json(['error'=>'Bạn đã đặt hàng thất bại!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chatorder  $chatorder
     * @return \Illuminate\Http\Response
     */
    public function show(Chatorder $chatorder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chatorder  $chatorder
     * @return \Illuminate\Http\Response
     */
    public function edit(Chatorder $chatorder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chatorder  $chatorder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chatorder $chatorder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chatorder  $chatorder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chatorder $chatorder)
    {
        //
    }
}
