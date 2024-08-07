<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Oproduct;
use App\Models\Pcategory;
use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $samples = Sample::latest()->get();
        $oproducts = Oproduct::latest()->get();
        return view('superadmin.index', compact('samples', 'oproducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:5|max:100',
            'description' => 'required|min:110|max:110000',
        ]);
        // dd($request->all());

        // $input = $request->except(['photos','category_id','_token']);
        $input = $request->all();

        if($sample = Sample::create($input)){
            $notifycation = [
                'message' => 'sample Create successfully',
                'alert-type' =>'success'
            ];
        }
        return redirect()->route('superadmin.sample.index')->with($notifycation);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function show(Sample $sample)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function edit(Sample $sample)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sample $sample)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sample  $sample
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sample $sample)
    {
        //
    }

    public function ajaxGetSampleInfo(Request $request){
        // two line of code work the same
        // $sample = sample::where('id','=',$request->id)->with('oproduct')->first();
        $sample = sample::with('oproduct:id,name')->find($request->id);


        return response()->json($sample);

    }
    // public function ajaxUpdateSampleInfo(Request $request){
    //     $validated = $request->validate([
    //         'id' => 'required',
    //         // 'name' => 'required|min:2|max:255',
    //     ]);
    //     $sample = Sample::find($request->id);
    //     $sampleTitle = $request->title;
    //     $sampleShortDescription = $request->short_description;
    //     $sampleDescription = $request->description;
    //     $sampleType = $request->type;
    //     $oproductId = $request->oproductId;
    //     $oproductName = Oproduct::find($oproductId)->name;

    //     if($sample->update(['name'=>$sampleTitle,'type'=> $sampleType , 'short_description'=>$sampleShortDescription, 'description'=>$sampleDescription,
    //     'oproduct_id'=>$oproductId])){
    //         $response = [
    //             'message'=>'cập nhật sample thành công',
    //             'alert-type'=>'success',
    //             'oproduct_name'=> $oproductName,
    //             'oproduct_id'=> $oproductId,
    //             'sample'=>$sample,
    //         ];
    //         return response()->json($response);
    //     }
    // }
    public function ajaxUpdateSampleInfoWithFormdata(Request $request){
        $sample = Sample::find($request->sampleId);
        $oproductId = $request->oproduct_id;
        $oproductName = Oproduct::find($oproductId)->name;

        if($sample->update($request->all())){
            $response = [
                'message'=>'cập nhật sample thành công',
                'alert-type'=>'success',
                'oproduct_name'=> $oproductName,
                'oproduct_id'=> $oproductId,
                'sample'=>$sample,
            ];
            return response()->json($response);
        }
    }
    public function ajaxRemoveSample( Request $request){
        $sample = Sample::find($request->id);
        if($sample->delete()){
            $response = [
                'message'=>'xóa sample thành công',
                'alert-type'=>'success'
            ];
            return response()->json($response);
        }
    }

    public function createProductFromSample(Request $request){
        $sample = Sample::findOrFail($request->sampleid);
        // dd($sample);
        $categories = Category::latest()->get();
        $fullNameDirectories = Storage::disk('public')->directories('photos');
        $directories =[];
        foreach ($fullNameDirectories as $fullNameDirectorie) {
            $directories[] = basename($fullNameDirectorie);
        }
        return view('admin.product.create', compact('categories','directories','sample'));
        // return view('admin.product.create', compact('categories','sample'));
    }
    public function createPostFromSample(Request $request){
        $sample = Sample::findOrFail($request->sampleid);
        $categories = Category::latest()->get();
        $fullNameDirectories = Storage::disk('public')->directories('photos');
        $directories =[];
        foreach ($fullNameDirectories as $fullNameDirectorie) {
            $directories[] = basename($fullNameDirectorie);
        }
        return view('admin.post.create', compact('categories','sample','directories'));
    }

}
