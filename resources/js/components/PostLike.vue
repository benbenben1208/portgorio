<template>
  <div class="app">
    <button type="button"
            class="btn shadow-none m-0 p-1"
            
    >
      <i class="fas fa-heart mr-1"
            :class="{'red-text' :this.isLikedBy}"
            @click="clickLike"
      >
        
      </i>
    </button>
    {{countLikes}}
  </div>
    
</template>

<script>
export default {
  props: {
    initialIsLikedBy : {
        type: Boolean,
        default: false,
    }, 
    initialCountLikes: {
        type: Number,
        default: 0,
    },
    authorized: {
      type: Boolean,
      default: false,
    },
    endpoint: {
      type: String,
      
    } ,  
  },
  data() {
    return {
      isLikedBy: this.initialIsLikedBy,
      countLikes: this.initialCountLikes,    
    }    
  },
  methods: {
    clickLike() {
        if(!this.authorized) {
          alert('部外者はいいねは使えないよ！');
          return
        }
        this.isLikedBy
          ? this.unlike()
          : this.like()
    },
    async like() {
      const response = await axios.put(this.endpoint)

      this.isLikedBy = true
      this.countLikes = response.data.countLikes
    },
    async unlike() {
      const response = await axios.delete(this.endpoint)
      
      this.isLikedBy = false;
      this.countLikes = response.data.countLikes
    }
  }

}
</script>

<style>

</style>