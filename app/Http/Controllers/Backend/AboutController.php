<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function edit(){
        $about = About::first();
        return view('admin.about.edit', compact('about'));
    }
    public function update(About $about, Request $request){
        $validated = $request->validate([
            'company_name' => 'required|min:2|max:255',
            'description' => 'required|min:2|max:11955',
            'contact' => 'required|min:1|max:11255',
        ]);
        $input = $request->except(['_token','_method']);//why?
        // dd($input);

        $about->update($input);

        $notifycation = [
            'message' => 'Cập nhật about thành công',
            'alert-type' =>'success'
        ];
        return redirect()->route('admin.dashboard')->with($notifycation);
    }
}
