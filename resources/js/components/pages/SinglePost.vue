<template>
    <div v-if="post" class="container">
        <h1>{{post.title}}</h1>
        <img v-if="post.image_path" :src="post.image_path" :alt="post.title">
        <img v-if="post.image" :src="`/storage/${post.image}`" :alt="post.title">
        <p>{{post.content}}</p>
        <h3>Autore di questo post: {{post.user.name}}</h3>  <p v-if="post.category">Categoria: {{post.category.name}}</p>
        <div v-if="post.tags.length > 0">
            <h4>Lista tags</h4>
            <ul>
                <li v-for="tag in post.tags" :key="tag.id"><router-link :to="{ name: 'single-tag', params: {slug: tag.slug} }">{{tag.name}}</router-link></li>
            </ul>
        </div>
        <div class="mt-5">
            <router-link :to="{name: 'home'}">Home Page</router-link>
        </div>
    </div>
</template>

<script>
export default {
   name:'SinglePost',
    data() {
        return {
            post: null
        }
    },

   created() {
        axios.get(`/api/posts/${this.$route.params.slug}`)
            .then((response) => {
                this.post = response.data;
            })
            .catch((e) => {
                // redirect alla pagina 404
                this.$router.push({name: 'page-404'});
            });
    }
}
</script>

<style>

</style>