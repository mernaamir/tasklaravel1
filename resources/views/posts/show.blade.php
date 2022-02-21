@extends('layouts.app')

@section('title') show @endsection

@section('content')


<div class="container" >

  <h2>Data show </h2>
  <div class="row">

  <table class="table">

        <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>

                <th scope="col">Description</th>
                <th scope="col">Posted By</th>
                <th scope="col">Created At</th>
              </tr>
            </thead>
         
            <tbody>
            <tbody>

              @foreach($post as $data)
      <tr>
          <td> {{$data->id}}</td>
             <td>  {{$data->title}}</td>

             <td>  {{$data->slug}}</td>

              <td>  {{$data->description}} </td>

             <td> {{$data->user->name}}</td>

             <td> {{$data->created_at->format('Y-m-d H:i:s')}}</td>
</tr>
@endforeach
</tbody>
</table>
</div>          
</div>
@endsection