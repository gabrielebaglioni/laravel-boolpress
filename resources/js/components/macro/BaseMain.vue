<template>
  <main class="main">
   <div>
     <PostsSection/>
   </div>
   
  </main>
</template>

<script>
import PostsSection  from '../sections/PostsSection.vue'
export default {
   name: 'BaseMian',
   components : {
      PostsSection,
   }
}
</script>

<style lang="scss" scoped>
  .main{
   background-color: lightgray;
  }
</style>