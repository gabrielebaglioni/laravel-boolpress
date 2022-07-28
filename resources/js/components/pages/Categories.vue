<template>
  <div class="container">
    <h1>Categorie</h1>
    <ul v-if="categories.length > 0">
        <li v-for="category in categories" :key="category.id">
            <router-link :to="{ name: 'single-category', params: { slug: category.slug } }">{{category.name}}</router-link>
        </li>
    </ul>
    <h2 v-else>Non sono presenti categorie</h2>
  </div>
</template>

<script>
export default {
   name:'Categories',
   data() {
        return {
            categories: []
        }
    },
    created() {
        axios.get('/api/categories')
            .then((response) => {
                this.categories = response.data;
            });
    }
}
</script>

<style>

</style>