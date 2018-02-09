@extends('layouts.app')

@section('content')
  <h3>{{$photo->title}}</h3>
  <p>{{$photo->description}}</p>
  <a class="button" href="/albums/{{$photo->albums_id}}">Go Back to Gallery</a>
  <hr>
  <img src="/storage/photos/{{$photo->albums_id}}/{{$photo->photo}}" alt="{{$photo->title}}">
  <br><br>
  
  {!! Form::open(['action' => ['PhotosController@destroy', $photo->id], 'method' => 'POST']) !!}
    {{ Form::hidden('_method', 'DELETE') }}
    {{ Form::submit('Delete Photo', ['class' => 'button alert']) }}
  {!! Form::close() !!}
  <hr>
  <small>Size: {{$photo->size}}</small>
@endsection