<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $title = 'Liên Hệ';
        $contact = Contact::latest()->first();
        return view('frontend.contact')->with([
            'contact'=>$contact,
            'title'=>$title,

        ]);
    }
    public function sentMessage(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
            'email' => 'required|email',
            'title' => 'required|min:2|max:255',
            'comment' => 'required|min:2|max:99255',

        ]);
        $input = $request->except(['_token','_method']);//why?


        if(Message::create($input)){
            $notifycation = [
                'message' => 'Tin nhắn gửi thành công, Chúng tôi sẽ liên hệ lại với bạn sớm!!!',
                'alert_class' =>'alert alert-success'
            ];
        }else{
            $notifycation = [
                'message' => 'Gửi tin nhắn thành công thất bại',
                'alert_class' =>'alert alert-danger'
            ];
        };

        return redirect()->back()->with($notifycation);
    }

    // -----------------------for admin
    public function edit(){
        $contact = Contact::first();
        return view('admin.contact.edit', compact('contact'));
    }
    public function update(Contact $contact, Request $request){
        $validated = $request->validate([
            'map' => 'required|min:2|max:21155',
            'information' => 'required|min:2|max:11955',
        ]);
        $input = $request->except(['_token','_method']);//why?

        if($contact->update($input)){
            $notifycation = [
                'message' => 'Cập nhật thành công',
                'alert-type' =>'success'
            ];
        }else{
            $notifycation = [
                'message' => 'Cập nhật thất bại',
                'alert-type' =>'danger'
            ];
        };

        return redirect()->route('admin.dashboard')->with($notifycation);
    }
    // -----------------------end for admin

}
