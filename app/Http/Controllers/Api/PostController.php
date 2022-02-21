<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Post;
use  App\Http\Resources\PostResource;



class PostController extends Controller
{
    Public function index(){
        $allPosts =Post::all();
        return PostResource::collection( $allPosts);
    }


    Public function show($postId){
        $Post=Post::find($postId);

        return new PostResource($Post);
        // return [
        //     'sldld'=>'dsdkcmdkcm',
        //     'id' =>  $Posts-> id ,
        //     'title'=> $Posts->title,
        //     'user_name'=>$Posts->user->name
        // ];
    }

    Public function store(){
    
        $data= request()->all();
        

       $post= Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
        ]);
        return new PostResource($Post);
    }
}
