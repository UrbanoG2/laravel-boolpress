<template>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <div class="col" v-for="(post, index) in cards.posts" :key="index">
                <div class="card">
                <img :src="'/storage/'+post.image" class="card-img-top" :alt="post.name">
                <div class="card-body">
                    <h5 class="card-title">{{ post.title }}</h5>
                    <p class="card-text">{{ post.content }}</p>
                </div>
                </div>
            </div>
        </div>

        <div class="row mt-3 bg-light">
            <ul class="list-inline bg-light">
                <li class="list-inline-item"> <button v-if="cards.prev_page_url" class="btn btn-primary" @click="changePage('prev_page_url')">Prev</button></li>
                <li class="list-inline-item"> <button v-if="cards.next_page_url" class="btn btn-primary" @click="changePage('next_page_url')">Next</button></li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
    name: "Main",
    props: ['cards'],
    methods: {
        changePage(kek) {
          this.$emit('changePage', kek);
        }
      }
    }

    // data() {
    //   return {
    //     posts: null,
    //     next_page_url: null,
    //     prev_page_url: null
    //   }
    // },

    // created() {
    //   this.getPosts('http://127.0.0.1:8000/api/posts');
    // },

    // methods: {
        
    //   changePage(kek) {
    //     let url = this[kek];
    //     if(url) {
    //       this.getPosts(url);
    //     }
    //   },

    //   getPosts(url){
    //       Axios.get(url).then(
    //         (result) => {
    //           this.posts = result.data.results.data;
    //           this.next_page_url = result.data.results.next_page_url;
    //           this.prev_page_url = result.data.results.prev_page_url;
    //         });
    //   }
      
    // }
  
</script>

<style lang="scss" scoped>
</style>