<template>
  <div>
    <div class="row">
      <div class="col-sm-offset-2 col-sm-8">
        <div class="form-group">
         <input type="text" v-model="message">
          <button type="button" v-on:click="submitChat">送信</button>
        </div>
        <div v-for="msg in messages" :key="msg">
            <p><span>{{msg.user.name}}</span>{{ msg.created_at }}
            <p>{{ msg.message }}
              <button @click="deleteMsg(msg.id)" class="ml-5 btn-sm">削除する</button>
            </p>
           
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  
  data() {
    return {
      message: '',
      messages: [],
    }
  },
   mounted() {
      this.getMessages();
  },  
  methods: {
     submitChat() {
     const url = '/chats/store';
      const params = {message: this.message};

      axios.post(url, params).then(res => {
       this.message = '';
       this.getMessages();

       
      });
     
    },
    getMessages() {
      const url = '/chats/getdata';
      axios.get(url).then(res => {
        this.messages = res.data;
      console.log(this.messages);
      });
    },
    deleteMsg(id) {
      const url = '/chats/delete/' + id;
      console.log(url);
      axios.post(url).then(res => {
        this.getMessages();
      });
    }
    
    }
  }

</script>
