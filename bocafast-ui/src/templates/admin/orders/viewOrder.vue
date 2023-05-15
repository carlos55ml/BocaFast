<script setup>
import NavBar from "../../../components/NavBar.vue";
</script>

<script>
import emitter from "./../../../assets/js/emitter";
import {
  getOrderById,
  deleteOrder,
  getQuery
} from "./../../../assets/js/adminHelper";
export default {
  data() {
    return {
      user: {},
      orderData: [],
      orderDetailsId: null
    };
  },
  mounted() {
    emitter.on("userObj", (userObj) => {
      this.user = userObj;
      this.checkAdmin();
    });
    this.orderDetailsId = getQuery('orderId')
    this.setPageData();
  },
  methods: {
    checkAdmin() {
      if (!this.user || !this.user.admin == 1) {
        alert("Necesitas ser administrador para ver esta pagina.");
        window.location = "/";
      }
    },
    async setPageData() {
      this.orderData = await getOrderById(this.orderDetailsId)
    },
    async deletePedido(orderId) {
      let confirmDelete = confirm(`¿Está seguro que desea borrar el pedido con id ${orderId}?`);
      if (confirmDelete) {
        let res = await deleteOrder(orderId);
        if(res>0) this.setPageData()
      }
    }
  },
};
</script>

<template>
  <NavBar></NavBar>

  <main class="uk-container uk-align-center" v-if="user && user.admin">
    <h1 class="uk-text-center">Ver detalle de pedido: <b>{{ orderDetailsId }}</b></h1>
    <div class="uk-container">
      <button class="uk-position-center uk-button uk-button-small uk-button-secondary" @click="setPageData()">Recargar pedido</button>
    </div>
    <br>
    <div class="uk-container">
      
    </div>
  </main>
</template>

<style scoped></style>
