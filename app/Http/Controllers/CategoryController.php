<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories=category::whereParentId(0)->get();

        return view('welcome',compact('categories'));
    }
    public function category_ajax($id){
        $categories = category::where("parent_id",$id)
        ->get();
return json_encode($categories);
    }
}
