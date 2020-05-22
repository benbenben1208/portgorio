@extends('layouts.admin')

@section('content')
  @foreach($posts as $post)
    @if($post->user)
       @include('admin.posts.card')
    @else
       @include('admin.posts.flozened_card')
    @endif   
@endforeach    
@endsection