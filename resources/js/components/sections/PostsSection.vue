<template>
  <section class="posts">
    <div class="container">
        <ul class="row">
            <li class="col-4 mb-5 post" v-for="post in posts" :key="post.slug">
                <PostCard :title="post.title" :content="post.content" :slug="post.slug"/>
            </li>
        </ul>
    </div>
  </section>
</template>

<script>
import Axios from 'axios';
import PostCard from '../commons/PostCard.vue'
export default {
   name:'PostsSection', 
   components:{
      PostCard,
   },

   data(){
        return {
          posts : []
      };
    },

   created(){
       Axios.get('http://127.0.0.1:8000/api/posts')
       .then((response) =>{
          this.posts =  (response.data);
       })
       .catch((e) =>{
        console.log(e);
       });
    },
}
</script>

<style lang="scss" scoped>
.posts {
    background-color: #efefef;
    padding: 3.125rem 0;
    ul {
        padding: 0;
        list-style: none;
    }
}
.post{
   padding: .625rem; 
}
</style>