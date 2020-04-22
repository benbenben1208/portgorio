<div class="form-group">
    <label for="name">名前</label>
    <input class="form-control" type="text" id="name" name="name"  required value="{{$user->name??old('name')}}">    
    </div>
    <div class="form-group">
      <label for="email">メールアドレス</label>  
      <input class="form-control" type="email" id="email" name="email"  required value="{{$user->email??old('email')}}">    
    </div>
    <div class="form-group">
      <label for="password">パスワード</label>  
      <input class="form-control" type="password" id="password" name="password" 　required>    
    </div>
    <div class="form-group">
      <label for="password_confirmation">パスワードの確認</label>  
      <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>    
    </div>