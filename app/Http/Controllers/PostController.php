<?php

namespace App\Http\Controllers;

use App\Models\User; 
use  App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\postRequest;
use App\Http\Requests\postRequestUpdate;


class PostController extends Controller
{
    public function index()
    {
        $allPosts =Post::all();
        // $allPosts =Post::paginate(5);


        //   dd($allPosts); 

        // return view('posts.index', compact('posts'),[
        //     'allPosts' => $allPosts
        // ]);
        // dd(compact('allPosts'));
        return view('posts.index',compact('allPosts'))
            ->with('allPosts', post::paginate(6));
            
    }
      public function create()
    {
        $users = User::all();

        return view('posts.create',[
            'users' => $users
        ]);
       
    }

    public function store(postRequest $request)
    {
        // dd('hmmm');
        // return 'ok';



        $data= $request->all();
        // dd($data);

        Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['post_creator'],
        ]);
        return redirect()->route('posts.index')->
        with('success','Posts created successfully.');
 

    }
    public function show($slug)
    {

    
    //  //query in db select * from posts where id = $postId
    // //  $allPosts=Post::find($id);

    $post = Post::where('slug', $slug)->get();
    return view('posts.show',['post'=>$post]);


    // return view('posts.show',compact('post'));


    
    // // ->with('allPosts',$allPosts);

    }






    public function edit($postId)
    {
        $users = User::all();

        // $data=post::where('id',$postId)->get(); 
        $post=Post::find($postId);
        return view('posts.edit',[
            'post' => $post,
            'users' => $users
        ]);    
      
    }

    // public function update($id)
    // {
    //  $allPosts=Post::find($id);

    //     $data= request()->all();
    //     // dd($data);

    //     Post::create([
    //         'title' => $data['title'],
    //         'description' => $data['description'],
    //         'user_id' => $data['post_creator'],
    //     ]);
    //     return redirect()->route('posts.index');
 
    // }


    public function update(postRequestUpdate $request,$post)
{
  
    // $data= request()->all();
    // // dd($data);

    $allPosts= Post::findOrFail($post);

    $allPosts->update([
        'title' => $request -> title,
        'description' => $request ->description,
        'user_id' => $request -> post_creator,
    ]);
    
    // $allPosts= $request->all();

        // $post->update($allPosts);
   
        // $post->update($request->all());

        return redirect()->route('posts.index');
        
    




    
}



public function destroy(post $post)
{
    // $data    = $request->user();

    // $allPosts= $data->customers()->find($postId);
    // $allPosts->delete();

    // return redirect()->route('posts.index');

    $post->delete();

    return redirect()->route('posts.index')
        ->with('success','Posts deleted successfully');
}


}



