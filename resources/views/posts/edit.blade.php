@extends('layouts.app')

@section('title') Edit @endsection

@section('content')

        <form method="post" action="{{route('posts.update',$post->id) }}" >
            @csrf
            @method('PUT')

            <div class="mb-3">
            <input type="text" class="form-control" id="exampleFormControlInput1" name="id" value="{{$post->id}}">

                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="title" value="{{$post->title}}" >
            </div>
            
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"> {{$post->description}} </textarea>  
            </div>

     

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Post Edit</label>
                  <select name="post_creator" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{$user->id}}" @if($user->id ==  $post->user_id) selected @endif >{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            
            <button class="btn btn-success">Update Post</button>
        </form>
@endsection