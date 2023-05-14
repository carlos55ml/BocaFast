<script setup>
import NavBar from '../components/NavBar.vue';
</script>

<script>
import emitter from './../assets/js/emitter'
import {countAllIngredients, countAllComplements, countAllPieces, countAllActiveOrders} from './../assets/js/adminHelper'
export default {
  data() {
    return {
      user: {},
      totalIngredientsNumber: 0,
      totalComplementsNumber: 0,
      totalPiecesNumber: 0,
      totalOrders: 0
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
    async setPageData() {
      this.totalIngredientsNumber = await countAllIngredients()
      this.totalComplementsNumber = await countAllComplements()
      this.totalPiecesNumber = await countAllPieces()
      this.totalOrders = await countAllActiveOrders()
    }
  }
}
</script>

<template>
  <NavBar ></NavBar>

  <main class="uk-container uk-align-center" v-if="user && user.admin" :key="user">
    <h1 class="uk-text-center">Administracion</h1>
    <ul class="adminSummary">
      <li>Total ingredentes guardados: <b>{{ totalIngredientsNumber }}</b> - <a href="/admin/ingredients/"><button class="uk-button uk-button-secondary uk-button-small">Modificar Ingredientes</button></a></li>
      <li>Total complementos guardados: <b>{{ totalComplementsNumber }}</b> - <a href="/admin/complements/"><button class="uk-button uk-button-primary uk-button-small">Modificar Complementos</button></a></li>
      <li>Total piezas predefinidas guardadas: <b>{{ totalPiecesNumber }}</b> - <a href="/admin/pieces/"><button class="uk-button uk-button-secondary uk-button-small">Modificar Piezas Predefinidas</button></a></li>
      <li>Total pedidos activos: <b>{{ totalOrders }}</b> - <a href="/admin/orders/"><button class="uk-button uk-button-danger uk-button-small">Gestionar Pedidos</button></a></li>
    </ul>
  </main>
</template>

<style scoped>

</style>

