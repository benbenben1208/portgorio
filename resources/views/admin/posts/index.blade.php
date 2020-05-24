@extends('layouts.admin')

@section('content')
  <div class="container">
  <form method="get" {{ route('admin.posts.index') }}>
      <select name="year">
        <option value="">---------<option>
        @foreach($years as $year)   
          <option value="{{ $year }}" @if(old('year') == $year) selected @endif >{{$year}}年<option>
        @endforeach 
      </select>
      <select name="month">
        <option value="">---------<option>
        @foreach($months as $month)   
          <option value="{{ $month }}" @if(old('month') == $month) selected @endif >{{ $month }}月<option>
        @endforeach     
      </select>
      <select name="day">
        <option value="">---------<option>
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
      @else
         @include('admin.posts.flozened_card')
    @endif   
@endforeach
   </div>
   <div class="mt-5 row justify-content-center">
      {{$posts->links()}}
     </div>
       
@endsection