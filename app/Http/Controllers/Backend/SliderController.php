<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::orderBy('order', 'ASC')->get();
        return view('admin.slider.index', compact('sliders'));
    }
    public function show(Slider $slider){
        return view('admin.slider.detail', compact('slider'));
    }
    public function create(){
        return view('admin.slider.create');
    }
    public function store(Request $request){
        $validated = $request->validate([
            'header' => 'nullable|min:2|max:255',
            'big_text' => 'nullable|min:2|max:255',
            'call_to_action' => 'nullable|min:2|max:255',
            'order' => 'nullable|integer|between:1,5',
            'image'=> [
                'required',
                'image',
                'mimes:jpg,jpeg,png,gif',
            ],
            'link' => 'nullable|min:10|max:255'
        ]);

        $input = $request->except('image');
        // dd($input);
        $slider = Slider::create($input);

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $slider->addMediaFromRequest('image')->toMediaCollection('sliders');
        }

        $notifycation = [
            'message' => 'Slider Create successfully',
            'alert-type' =>'success'
        ];
        return redirect()->route('admin.sliders.index')->with($notifycation);
    }
    public function edit(Slider $slider){
        return view('admin.slider.edit', compact('slider'));
    }
    public function update(Slider $slider, Request $request){
        $validated = $request->validate([
            'title' => 'nullable|min:2|max:255',
            'order' => 'nullable|integer|between:1,5',
            'image'=> [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,gif',
            ],
            'link' => 'nullable|min:10|max:255'
        ]);
        $input = $request->except('image');
        $slider->update($input);

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $slider->addMediaFromRequest('image')->toMediaCollection('sliders');
        }

        $notifycation = [
            'message' => 'Slider Updated successfully',
            'alert-type' =>'success'
        ];
        return redirect()->route('admin.sliders.index')->with($notifycation);
       //return $request->file('image');
    }
    public function destroy(Slider $slider, Request $request){
        $slider->delete();
        $notification = [
            'message' => 'Slider Deleted successfully',
            'alert-type' =>'success'
        ];
        return redirect()->back()->with($notification);
    }


}
