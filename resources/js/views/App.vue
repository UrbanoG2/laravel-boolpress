<template>
  <div>
      <Header></Header>
      <!-- <Main></Main> -->
      <router-view></router-view>
  </div>
</template>

<script>

import Header from '../components/Header.vue';


export default {
    name:"App",
    components: {
        Header,
        // Main
    }
}
</script>

<style>

</style>