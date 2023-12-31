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

    public function index(){
        //postモデルを介して、データベースpostsテーブルの内容を取得できる。
        // $posts=Post::all();
        //  dd($posts);

        // postsテーブルのログインユーザーのデータを取得
         $posts=Post::where('user_id', auth()->id())->get();
        
        // postsテーブルのログインユーザー以外のデータを取得
        //$posts=Post::where('user_id', '!=', auth()->id())->get();

        // compact関数　変数名とその値から配列を作成します。
        // post/index.blade.phpを表示 
        return view('post.index',compact('posts'));
        }
            
    public function store(Request $request){

        // $post = Post::create([
        $validated = $request->validate([
                'title' => 'required|max:15',
                'body' => 'required|max:400',

        ]);

        // バリデーション情報に、user_idを追加することが出来る。
        $validated['user_id'] = auth()->id();

        // dd($validated);

        $post = Post::create($validated);
        $request->session()->flash('message','保存しました');
        return back();

    }
}
