<div class="form-group d-flex flex-row align-items-center">
  <div>
    <img class="rounded-circle" width="100" height="100" src="{{ asset('storage/user_images/' . Auth::user()->id . '.jpg')}}" >
  </div>  
  <div class="col">
  <input type="text" name="caption" class="form-control" value="{{ $post->caption ?? old('caption')}}"　>  
  </div>
</div>
<div>
  <input type="file" name="photo" accept="image/jpeg,image/gif,image/png" >  
</div>