<?php

namespace App\Http\Controllers;

use App\Models\Webconfig;
use Illuminate\Http\Request;

class WebconfigController extends Controller
{
    public function webconfigManage(){
        $webconfig = Webconfig::first();
        return view('admin.webconfig.edit', compact('webconfig'));
    }
    public function update(Request $request){
        $validated = $request->validate([
            'header_code' => 'nullable|min:10|max:9000',
            'body_code' => 'nullable|min:10|max:9000',
            'footer_code' => 'nullable|min:10|max:9000',
        ]);
        // dd($request->all());

        $input = $request->except([]);
        // update some text, num inputs
        // dd($input);
        Webconfig::first()->update($input);

        $notifycation = [
            'message' => 'Cập nhật cấu hình web thành công',
            'alert-type' =>'success'
        ];
        return redirect()->route('admin.dashboard')->with($notifycation);
    }
}
