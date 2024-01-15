<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }
    public function create(){
        return view('admin.category.create');
    }
    public function store(Request $request){
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

        if($category = Category::create($input)){
            // add image
            if($request->hasFile('image') && $request->file('image')->isValid()){
                $category->addMediaFromRequest('image')->toMediaCollection('categories','categoryFiles');
            }
            // add parent category
            if($request->category_id){
                // dd($request->category_id);
                $parentCategory = Category::findOrFail($request->category_id);
                if($parentCategory){
                    // save chilren to parent
                    $parentCategory->children()->save($category);
                }
            }

            $notifycation = [
                'message' => 'Thêm mới danh mục sản phẩm thành công',
                'alert-type' =>'success'
            ];
            return redirect()->route('admin.categories.index')->with($notifycation);
        }
    }

    public function edit(Category $category){
        return view('admin.category.edit', compact('category'));
    }
    public function update(Category $category, Request $request){
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
            $parentCategory = Category::findOrFail($request->category_id);
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
            $category->clearMediaCollection('categories','categoryFiles');
            $category->addMediaFromRequest('image')->toMediaCollection('categories','categoryFiles');
        }

        $notifycation = [
            'message' => 'Cập nhật danh mục sản phẩm thành công',
            'alert-type' =>'success'
        ];
        return redirect()->route('admin.categories.index')->with($notifycation);
    }

    public function ajaxDelete(Request $request){
        $category = Category::whereId($request->categoryID)
        ->first();
        if($category->delete()){
            return response()->json(['message'=>'xóa danh mục sản phẩm thành công']);
        }
        return response()->json(['error'=>'some errors']);

    }
}
