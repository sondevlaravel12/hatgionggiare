<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pcategory;
use Illuminate\Http\Request;

class PcategoryController extends Controller
{
    public function index(){
        $categories = Pcategory::latest()->get();
        return view('admin.postcategory.index', compact('categories'));
    }
    public function create(){
        return view('admin.postcategory.create');
    }
    public function store(Request $request){
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
            'image'=> [
                'image',
                'mimes:jpg,jpeg,png,gif',
            ],
            'description' => 'required|min:10',
        ]);
        $input = $request->except(['image','category_id']);
        // dd($request->hasFile('image'));

        if($category = Pcategory::create($input)){
            // add image
            if($request->hasFile('image') && $request->file('image')->isValid()){
                $category->addMediaFromRequest('image')->toMediaCollection('postcategories','postCategoryFiles');
            }
            // add parent category
            if($request->category_id){
                // dd($request->category_id);
                $parentCategory = Pcategory::findOrFail($request->category_id);
                if($parentCategory){
                    // save chilren to parent
                    $parentCategory->children()->save($category);
                }
            }else{
                $category->parent_id =0;
                $category->save();
            }

            $notifycation = [
                'message' => 'Thêm mới danh mục sản phẩm thành công',
                'alert-type' =>'success'
            ];
            return redirect()->route('admin.pcategories.index')->with($notifycation);
        }
    }

    public function edit(Pcategory $category){
        return view('admin.postcategory.edit', compact('category'));
    }
    public function update(Pcategory $category, Request $request){
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
            'image'=> [
                'image',
                'mimes:jpg,jpeg,png,gif',
            ],
            'description' => 'required|min:10',
        ]);
        $input = $request->except('image', 'category_id');

         // add parent category
         if($request->category_id!='not_selected'){
            $parentCategory = Pcategory::findOrFail($request->category_id);
            if($parentCategory){
                // sync chilren to parent
                $parentCategory->children()->save($category);
            }
        }else{

            $input['parent_id']=0;
            // dd($input);
        }
        //save
        $category->update($input);

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $category->clearMediaCollection('postcategories','postCategoryFiles');
            $category->addMediaFromRequest('image')->toMediaCollection('postcategories','postCategoryFiles');
        }

        $notifycation = [
            'message' => 'Cập nhật danh mục sản phẩm thành công',
            'alert-type' =>'success'
        ];
        return redirect()->route('admin.pcategories.index')->with($notifycation);
    }

    public function ajaxDelete(Request $request){
        $category = Pcategory::whereId($request->categoryID)
        ->first();
        if($category->delete()){
            return response()->json(['message'=>'xóa danh mục sản phẩm thành công']);
        }
        return response()->json(['error'=>'some errors']);

    }
}
