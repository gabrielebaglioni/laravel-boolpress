<<template>
  <div class="card">
    <h3>{{title}}</h3>
    <div class="card-content">
        {{content}}
    </div>
    <router-link :to="{ name: 'single-post', params: {slug: slug} }">Leggi di più</router-link>
  </div>
</template>

<script>
export default {
    name: 'BaseCard',
    props: {
        title: {
            type: String
        },
        content: {
            type: String
        },
        slug: {
            type: String,
        },
    }
}
</script>

<style lang="scss" scoped>
.card {
    background-color: #fff;
    border-radius: 1.25rem;
    padding: .625rem;
    box-shadow: 0 0 5px 2px #ddd;
}
</style>