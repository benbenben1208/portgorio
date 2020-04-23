@extends('layouts.app')

@section('title','投稿id' . $post->id . 'の編集ページ')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-xl-7 col-lg-8 col-md-10 col-sm-11 post-card mx-auto">
        <div class="card mt-5">
         <div class="card-header">
           編集画面    
         </div>
       @include('error_card_list')
       <div class="card-body">
       <form enctype="multipart/form-data" method="POST"  action="{{ route('posts.update',['post' => $post->id])}}">
          @method('PATCH')
          @csrf
         @include('posts.form')
           <button type="submit" class="btn btn-block purple-gradient mt-3">編集する</button>
       </form>
       </div>    
      </div>
    </div>
    </div> 
  </div>
@endsection
