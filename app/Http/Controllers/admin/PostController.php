<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(){
        $data = Post::with(['category', 'tag'])->get();
        //dd($data);
        return view('admin.post.index', compact('data'));
    }

    public function create(){
        $data['category'] = Category::all();
        $data['tag'] = Tag::all();
        return view('admin.post.add', compact('data'));
    }

    public function store(Request $request){
        $name = $request->file('thumb')->getClientOriginalName();
        $request->thumb->storeAs('public/posts', $name);
        Post::create([
            'name'=>(string) $request->input('name'),
            'slug'=>Str::of($request->name)->slug('-'),
            'description'=>(string) $request->input('description'),
            'content'=>(string) $request->input('content'),
            'thumb'=>'storage/posts/' . $name,
            'category_id'=> $request->category_id,
            'tag_id'=>$request->tag_id,
        ]);
        return redirect()->route('admin.posts.index');
    }

    public function getEdit(Request $request){
        $id = $request->id;
        return view('admin.post.edit', ['id'=>$id]);
    }

    public function edit(Request $request, int $id){
        $name = $request->file('thumb')->getClientOriginalName();
        $request->thumb->storeAs('public/posts', $name);
        Post::where('id', $id)->update([
            'name'=> $request->name,
            'slug' => Str::of($request->name)->slug('-'),
            'description'=>(string) $request->input('description'),
            'content'=>(string) $request->input('content'),
            'thumb'=>'storage/posts/' . $name,
            'category_id'=> $request->category_id,
            'tag_id'=>$request->tag_id,
        ]);
        return redirect()->route('admin.posts.index');
    }

    public function delete(Request $request){
        $Post = Post::where('id', $request->id);
        $Post->delete();
        return redirect()->route('admin.posts.index');
    }
}
