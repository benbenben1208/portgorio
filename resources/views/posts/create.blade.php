@extends('layouts.app')

@section('title', '投稿ページ')
@include('nav')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-xl-7 col-lg-8 col-md-10 col-sm-11 post-card mx-auto">
        <div class="card mt-5">
         <div class="card-header">
           投稿画面    
         </div>
       @include('error_card_list')
       <div class="card-body">
       <form enctype="multipart/form-data" method="POST"  action="{{ route('posts.store')}}">
          @csrf
         @include('posts.form')
         <button type="submit" class="btn btn-block purple-gradient mt-3">投稿する</button>
       </form>
       </div>    
      </div>
    </div>
    </div> 
  </div>
    
@endsection