<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function showCreateForm(){
        if(auth()->check()){
            return view('create-post');
        }else{
            return redirect("/");
        }
        
    }

    public function storeNewPost(Request $request){
       $incomingFields= $request->validate([
        'title' => 'required',
        'body' => 'required'
       ]);
       $incomingFields['title'] = strip_tags($incomingFields['title']);
       $incomingFields['body'] = strip_tags($incomingFields['body']);
       $incomingFields['user_id']= auth()->id();
       $newPost= Post::create($incomingFields);

       return redirect("/post/{$newPost->id}")
       ->with('success','New Post Created Successfully');
    }

    public function viewSinglePost(Post $post ){
        
        return view('single-post',['post'=>$post]);
    }
}
