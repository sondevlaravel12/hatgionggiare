<?php

namespace App\Http\Controllers;

use App\Models\OtherInformation;
use Illuminate\Http\Request;

class OtherInforController extends Controller
{
    public function editBankInfor(){
        $otherInformation = OtherInformation::where('key','bank_infor')->first();
        // dd($bankInfor);
        return view('admin.bankinformation.edit', compact('otherInformation'));

    }
    public function updateBankInfor(OtherInformation $otherInformation ,Request $request){
        $validated = $request->validate([
            'title' => 'required|min:2|max:255',
            'content1' => 'required|min:2|max:11955',
        ]);
        $input = $request->except(['_token','_method']);//why?
        // dd($otherInformation);
        if($otherInformation->update($input)){
            $notifycation = [
                'message' => 'Cập nhật thông tin tài khoản ngân hàng thành công',
                'alert-type' =>'success'
            ];
        }else{
            $notifycation = [
                'message' => 'Cập nhật thông tin tài khoản ngân hàng thất bại',
                'alert-type' =>'error'
            ];
        }
        return redirect()->route('admin.dashboard')->with($notifycation);
    }
}
