<template>
  <div>
    <a  class="text-muted" href="">
      フォロー{{countFollowees}}
    </a>
    <a class="text-muted" href="">
      フォロワー{{countFollowers}}  
    </a>
    <button class="btn-sm  shadow-none border border-primary ml-3"
            :class="buttonColor"
           
            @click="clickFollow"
            
    >
      <i class="fas fa-user-check"
        :class="buttonIcon"

        >{{ buttonText}}</i>

    </button>
  </div>
</template>

<script>
export default {
  props: {
      initialIsFollowedBy: {
          type: Boolean,
          default: false,
          
      },
      initialCountFollowers : {
          type: Number,
          default: 0,
      },
      initialCountFollowees: {
          type: Number,
          default: 0,
      },
      authorized: {
          type: Boolean,
          default: false,
      },
      endpoint: {
          type: String,
      },
      
      

  },
  data() {
      return {
          isFollowedBy: this.initialIsFollowedBy,
          countFollowers: this.initialCountFollowers,
          countFollowees:this.initialCountFollowees,
         
      }
  },
  computed: {
      buttonColor() {
         return this.isFollowedBy
                ? 'bg-primary text-white'
                : 'bg-white'
      },
      buttonIcon() {
          return this.isFollowedBy
                 ? 'fas fa-user-check'
                 : 'fas fa-user-plus'
      },
      buttonText() {
          return this.isFollowedBy
                 ? 'フォロー解除'
                 : 'フォローする'
      },

  },
  methods: {
      clickFollow() {
          if(!this.authorized) {
              alert('フォロー機能はログインしてからやってくださいよ！')
              return
          }
          this.isFollowedBy
              ? this.unfollow()
              : this.follow()
      },
      async follow() {
          const response = await axios.put(this.endpoint)

          this.isFollowedBy = true

          this.countFollowers = response.data.countFollowers
          this.counfFollowees = response.data.countFollowees

      },
      async unfollow() {
          const response = await axios.delete(this.endpoint)
          
          this.isFollowedBy = false
           this.countFollowers = response.data.countFollowers
          this.counfFollowees = response.data.countFollowees
      },
  },

}
</script>

