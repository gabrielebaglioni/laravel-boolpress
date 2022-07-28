<template>
  <div v-if="category" class="container">
    <h1>{{category.name}}</h1>
        <h3>Lista post associati:</h3>
        <ul>
            <li v-for="post in category.posts" :key="post.id">
                <router-link :to="{ name: 'single-post', params: { slug: post.slug } }">{{post.title}}</router-link>
            </li>
        </ul>
  </div>
</template>

<script>
export default {
    name: 'SingleCategory',
    data() {
        return {
            category: null,
        }
    },
    created() {
        axios.get(`/api/categories/${this.$route.params.slug}`)
            .then((resp) => {
                this.category = resp.data
            });
    }
}
</script>

<style>
</style>