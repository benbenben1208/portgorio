// 変数userPhotoに画像アップロードのinput要素を習得し、代入
let userPhoto = document.getElementById('user_profile_photo');
//input要素にchangeイベントを追加
userPhoto.addEventListener('change', (e) => {
    
    
    if (e.target.files.length) {
       let reader = new FileReader;
        reader.onload = () => {
             
           let userProfilePhoto = getElementById('thumbnail');
           let userPhotoPreview =document.getElementById('user_photo_preview');
            userPhotoPreview.classList.style.display="block";
           userProfilePhoto.setAttribute('src', reader.result);

          


          
        }
        return reader.readAsDataURL(e.target.files[0]);
    }
   
    
});

