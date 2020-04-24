@extends('layouts.app')   
  @section('title', '投稿詳細画面')
  @include('nav')
  @section('content')
      
  <div class="container">
    @include('posts.card')
  </div>  
  @endsection  