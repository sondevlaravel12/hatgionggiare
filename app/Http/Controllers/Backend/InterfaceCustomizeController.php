<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class InterfaceCustomizeController extends Controller
{
    public function categoryDisplay(){
        $categories = Category::all();
        return view('admin.customize interface.category_display', compact('categories'));
    }
    public function ajaxChangedInforTab(Request $request){
        $category = Category::findOrFail($request->category_id);
        if($category){
            $category->in_infor_tab = $request->status;
            $category->save();
        }
        $reponse = [
            'message'=>'thiết lập danh mục trên tab infor thành công',
        ];
        return response()->json($reponse);
    }
    public function ajaxChangedSidebarWidget(Request $request){
        $category = Category::findOrFail($request->category_id);
        if($category){
            $category->in_sidebar_widget = $request->status;
            $category->save();
        }
        $reponse = [
            'message'=>'thiết lập danh mục trên sidebar wedget thành công',
        ];
        return response()->json($reponse);
    }
}
