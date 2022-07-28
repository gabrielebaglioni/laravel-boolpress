<template>
  <div v-if="tag" class="container">
    <h1>{{tag.name}}</h1>
    <template v-if="tag.posts.length > 0">
        <h3>Lista post associati:</h3>
        <ul>
            <li v-for="post in tag.posts" :key="post.id">
                <router-link :to="{ name: 'single-post', params: { slug: post.slug } }">{{post.title}}</router-link>
            </li>
        </ul>
    </template>
  </div>
</template>

<script>
export default {
    name: 'SingleTag',
    data() {
        return {
            tag: null
        }
    },
    created() {
        axios.get(`/api/tags/${this.$route.params.slug}`)
            .then((resp) => {
                this.tag = resp.data;
            });
    }
}
</script>

<style>

</style>