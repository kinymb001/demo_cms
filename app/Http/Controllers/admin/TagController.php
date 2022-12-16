<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index(){
        $data = Tag::all();
        return view('admin.Tag.index', compact('data'));
    }

    public function create(){
        return view('admin.Tag.add');
    }

    public function store(Request $request){
        Tag::create([
            'name'=>(string) $request->input('name'),
            'slug'=>Str::of($request->name)->slug('-'),
        ]);
        return redirect()->route('admin.tags.index');
    }

    public function getEdit(Request $request){
        $id = $request->id;
        return view('admin.Tag.edit', ['id'=>$id]);
    }

    public function edit(Request $request, int $id){
        Tag::where('id', $id)->update([
            'name' => $request->name,
            'slug' => Str::of($request->name)->slug('-'),
        ]);
        return redirect()->route('admin.tags.index');
    }

    public function delete(Request $request){
        $Tag = Tag::where('id', $request->id);
        $Tag->delete();
        return redirect()->route('admin.tags.index');
    }
}
