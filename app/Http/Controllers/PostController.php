<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//postモデルを使うためのuse宣言
use App\Models\Post;

class PostController extends Controller
{
    public function create(){
    //post/create.blade.phpを表示
    return view('post.create');
    }

    public function store(Request $request){

        // $post = Post::create([
        $validated = $request->validate([
                'title' => 'required|max:20',
                'body' => 'required|max:400',

        ]);

        $post = Post::create($validated);
        $request->session()->flash('message','保存しました');
        return back();

    }
}
