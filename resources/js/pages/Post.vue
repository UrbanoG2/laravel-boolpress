<template>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col">
            <div class="card">
                <img :src="'/storage/'+post.image" class="card-img-top" :alt="post.title">
                
                <div class="card-body">
                    <h5 class="card-title">{{ post.title }}</h5>
                    <p class="card-text">{{ post.text }}</p>
                </div>
            </div>

            <router-link class="btn btn-warning" :to="{name: 'home'}">Home</router-link>
            
            <router-link class="btn btn-danger" :to="{name: 'posts'}">All posts</router-link>
        </div>
        

    </div>
</template>

<script>
import Axios from "axios";

export default {
  name:"Post",
  props:["id"],
    data(){
        return {
            post:null,
        }
    },

    created() {
        const url = "http://127.0.0.1:8000/api/v1/posts/" + this.id;
        this.getPost(url);
    },

  methods: {
      getPost(url) {
          Axios.get(url).then(
              (result) => {
                  this.post = result.data.results.data;
              }
          )
      }
  }




}
</script>

<style>

</style>