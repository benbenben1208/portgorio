@extends('layouts.admin')

@section('content')
<div class="container">
  @foreach($comments as $comment)
    <div class="card">
      @if($loop->first)
        <div class="mt-2 mb-2">
      @endif    
  
     <div class="mb-3">
       <p>{{ $comment->user->name }}</p>
       <span class="ml-3">{{$comment->comment}}</span>
     
       <form method="POST" action="{{ route('admin.comments.destroy', ['comment' => $comment->id ])}}">
         @csrf
         @method('DELETE')
        <button type="submit" class="btn-danger mt-3">削除する</button>
       </form>
     </div>
      @if($loop->last)
        </div>
      @endif
    </div>
  @endforeach
 </div>
 <div class="mt-5 row justify-content-center">
  {{$comments->links()}}
 </div>
</div>
@endsection