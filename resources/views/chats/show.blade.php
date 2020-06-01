@extends('layouts.app')
@section('title', 'チャット')
@section('content')
  @include('nav')
  <div class="container">
    <h2>{{ $group->name }}のチャットルーム</h2>
    <chat-page
      :group='@json($group)'
    >
        
    </chat-page>  
    
  </div>
      
  </div>
@endsection