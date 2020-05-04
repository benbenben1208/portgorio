<div class="form-group d-flex flex-row align-items-center">
  <div>
    
    @if(Auth::user()->profile_photo)
      <img class="rounded-circle" width="100" height="100" src="{{ asset('storage/user_images/' . Auth::user()->id . '.jpg')}}" >
    @else
      <i class="fas fa-user-circle fa-5x"></i>
    @endif

  </div>  
  <div class="col">
    <input type="text" placeholder="キャプションを書いてね！" name="caption" class="form-control" value="{{ $post->caption ?? old('caption')}}">
  </div>
</div>

  <input class="mt-3 mb-3" type="file" name="photo" accept="image/jpeg,image/gif,image/png" >  
