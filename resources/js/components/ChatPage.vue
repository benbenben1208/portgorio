<template>
  <div>
    <div class="row">
      <div class="col-sm-offset-2 col-sm-8">
        <div class="form-group">
         <textarea cols="60" rows="5" v-model="message"></textarea>
        </div>
        
         <input type="file" @change="checkPhoto"  v-if="view">
         <p v-if="checkedPhoto">
           <img :src="checkedPhoto" />
         </p>
        <button type="button" @click="submitChat">送信</button>
         
        
        <div v-for="msg in messages" :key="msg.id">
            <p><span>{{msg.user.name}}</span>{{ msg.created_at }}
            <p>{{ msg.message }}
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
      file: '',
      checkedPhoto: '',
    }
  },
   mounted() {
     
      this.getMessages();
  },  
  methods: {
     submitChat() {
     const url = '/chats/store/' + this.group.id ;
      const params = {message: this.message};
      
      axios.post(url, params).then(res => {
       this.message = '';
       this.getMessages();

       
      });
     
    },
    checkPhoto(e) {
      this.file = e.target.files[0];
      console.log(this.file.type);
      if (!this.file.type.match('image.*')) {
        '画像ファイルを選択してください';
         this.checkedPhoto = '';
         return;
      }
      this.createImage(this.file);

    },
    createImage(file) {
      let reader = new FileReader;
      reader.readAsDataURL(file);
      reader.onload = e => {
        this.checkedPhoto = e.target.result;
        
      }
    },
    getMessages() {
      const url = '/chats/getdata/' + this.group.id ;
      axios.get(url).then(res => {
        
        this.messages = res.data.chats;
        this.auth_user = res.data.auth_user;
       
      
      });
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
