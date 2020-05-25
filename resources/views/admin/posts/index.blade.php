@extends('layouts.admin')

@section('content')
  <div class="container">
    <div class="bg-white">
      <p><a href="{{ route('admin.posts.index')}}">投稿一覧</a></p>
      <p><a href="{{ route('admin.comments.index')}}">コメント一覧</a></p>
      <p><a href="{{ route('admin.flozened.index')}}">凍結中のアカウント一覧</a></p>
   
      
    </div>  
    <h1 class="h2">ユーザー投稿一覧</h1>
  <form method="get" {{ route('admin.posts.index') }}>
      <select name="year">
        <option value="">---年---<option>
        @foreach($years as $year)   
          <option value="{{ $year }}" @if(old('year') == $year) selected @endif >{{$year}}年<option>
        @endforeach 
      </select>
      <select name="month">
        <option value="">---月---<option>
        @foreach($months as $month)   
          <option value="{{ $month }}" @if(old('month') == $month) selected @endif >{{ $month }}月<option>
        @endforeach     
      </select>
      <select name="day">
        <option value="">---日---<option>
        @foreach($days as $day)   
          <option value="{{ $day }}" @if (old('day') == $day) selected @endif >{{ $day }}日<option>
        @endforeach     
      </select>
      <input type="text" placeholder="検索ワード" name="keyword" value="{{old('keyword')}}">
      <button class="rounded" type="submit">検索する</button>
  </form>
    @foreach($posts as $post)
      @if($post->user)
         @include('admin.posts.card')
      
    @endif   
@endforeach
   </div>
   <div class="mt-5 row justify-content-center">
      {{$posts->links()}}
     </div>
       
@endsection