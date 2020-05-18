

require('./bootstrap');

window.Vue = require('vue');



Vue.component('example-component', require('./components/ExampleComponent.vue').default);
 
import PostLike from './components/PostLike';
import FollowButton from './components/FollowButton';
import PostTagsInput from './components/PostTagsInput';

 

const app = new Vue({
    el: '#app',
    components: {
        PostLike,
        FollowButton,
        PostTagsInput,
    }
});
