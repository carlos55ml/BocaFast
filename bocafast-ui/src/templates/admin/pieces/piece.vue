<script setup>
import NavBar from '../components/NavBar.vue';
</script>

<script>
import emitter from './../assets/js/emitter'
import {} from './../assets/js/adminHelper'
export default {
  data() {
    return {
      user: {},
    };
  },
  mounted() {
    emitter.on('userObj', userObj =>{ this.user = userObj; this.checkAdmin() })
    this.setPageData()
  },
  methods: {
    checkAdmin() {
      if(!this.user || !this.user.admin == 1) {
        alert("Necesitas ser administrador para ver esta pagina.")
        window.location = '/'
      }
    },
    async setPageData() {}
  }
}
</script>

<template>
  <NavBar></NavBar>

  <main class="uk-container uk-align-center" v-if="user && user.admin" :key="user">
    <h1 class="uk-text-center">Bocata</h1>
    
  </main>
</template>

<style scoped>

</style>

