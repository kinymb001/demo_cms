<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $data = Category::all();
        return view('admin.category.index', compact('data'));
    }

    public function create(){
        return view('admin.category.add');
    }

    public function store(Request $request){
        Category::create([
            'name'=>(string) $request->input('name'),
            'slug'=>Str::of($request->name)->slug('-'),
        ]);
        return redirect()->route('admin.categories.index');
    }

    public function getEdit(Request $request){
        $id = $request->id;
        return view('admin.category.edit', ['id'=>$id]);
    }

    public function edit(Request $request, int $id){
        Category::where('id', $id)->update([
            'name' => $request->name,
            'slug' => Str::of($request->name)->slug('-'),
            ]);
        return redirect()->route('admin.categories.index');
    }

    public function delete(Request $request){
        $category = Category::where('id', $request->id);
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
