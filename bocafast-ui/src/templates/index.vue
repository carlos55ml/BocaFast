<script setup>
import NavBar from '../components/NavBar.vue';


</script>

<script>
import emitter from './../assets/js/emitter'
export default {
  data() {
    return {
      user: {}
    };
  },
  mounted() {
    emitter.on('userObj', user =>{ this.user = user })
  },
  methods: {}
}
</script>

<template>
  <NavBar></NavBar>

  <main>
    <div class="uk-container uk-align-center">
      <h1 class="uk-text-center">
        Bienvenido a <span>Boca<span style="color: red">Fast</span></span><span v-if="this.user.username">, {{ this.user.username }}</span>
      </h1>
    </div>
    <div class="uk-container">
      <h2 class="uk-text-center"><span style="color:red;">Nuestros</span> productos:</h2>
    </div>
  </main>
</template>

<style scoped>

</style>

