<template>
  <div>
    <div class="row">
      <div class="col-sm-offset-2 col-sm-8">
        <div class="form-group">
         <textarea cols="60" rows="5" v-model="message"></textarea>
        </div>
        
         <input type="file" @change="checkPhoto"  v-if="view">
         <p v-if="checkedPhoto">
           <img class="preview-img" :src="checkedPhoto" />
         </p>
         <p class="mt-2 text-danger">{{ alert }}</p>
        <button type="button" @click="submitChat">送信</button>
         
        
        <div v-for="msg in messages" :key="msg.id">
            <p><span>{{msg.user.name}}</span>{{ msg.created_at }}</p>
            <div v-if="msg.img_path" class="image-trim">
              <img :src="msg.img_path">
            </div>
            <p v-if="msg.message">{{ msg.message }}
              <button v-if="msg.user_id === auth_user.id" @click="deleteMsg(msg.id)" class="ml-5 btn-sm">削除する</button>
            </p>

           
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    group : {
      type: Object,
      default: null,
      
    }
  },
  data() {
    return {
      message: '',
      messages: [],
      auth_user: [],
      view: true,
      alert: '',
      file: '',
      checkedPhoto: '',
    }
  },
   mounted() {
     
      this.getMessages();
  },  
  methods: {
     async submitChat() {
     const url = '/chats/store/' + this.group.id ;
     let data = new FormData;
     data.append('photo', this.file);
     data.append('message', this.message);
      
      const res = await axios.post(url, data, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      });
      this.message = '';
      this.checkedPhoto = '';
      this.file = '';
      this.getMessages();
      this.alert = res.data.success;
      this.checkedPhoto = '';
      this.file = '';
      this.getMessages();
      
      this.view = false;
      this.$nextTick(function() {
        this.view = true;
      })


    },
    checkPhoto(e) {
      this.alert = '';
      this.file = e.target.files[0];
      if (!this.file.type.match('image.*')) {
         this.alert = '画像ファイルを選択してください';
         this.checkedPhoto = '';
         
         return;
      }
      this.createPhoto(this.file);

    },
    createPhoto(file) {
      let reader = new FileReader;
      reader.readAsDataURL(file);
      reader.onload = e => {
        this.checkedPhoto = e.target.result;
        
      }
      this.alert = 'この画像でよければ送信してください';
    },
    async getMessages() {
      const url = '/chats/getdata/' + this.group.id ;
      const res = await axios.get(url);
      this.messages = res.data.chats;
      this.auth_user = res.data.auth_user;
      

    },
    deleteMsg(id) {
      const url = '/chats/delete/' + id;
     
      axios.post(url).then(res => {
        this.getMessages();
      });
    },
    
  },
  
  
    

  }

</script>
