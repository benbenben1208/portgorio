@extends('layouts.app')
@section('title', 'チャット')
@section('content')
  @include('nav')
  <div class="container">
    <h2>チャットルーム</h2>
      <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
          <div class="form-group">
            
          </div>
          <div class="messages"></div>
        </div>
      </div>
      
  </div>
@endsection