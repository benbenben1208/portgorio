<template>
  <div>
    <h2>チャットルーム</h2>
    <div class="row">
      <div class="col-sm-offset-2 col-sm-8">
        <div class="form-group">
         <input type="text" v-model="message">
          <button type="button" v-on:click="submitChat">送信</button>
        </div>
        <div class="messages">
        　　{{message}}
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
  methods: {
    submitChat() {
      const url = '/chats/store';
      const params = {message: this.message};

      axios.post(url, params).then(res => {
      
       this.message = 'あいうえお';
      });
    },
    // getMessages() {
    //   const url = chats/getdata;
    //   axios.get(url).then(res => {
    //     this.messages = res.data;
    //   });
    // }  
    }
  }

</script>
