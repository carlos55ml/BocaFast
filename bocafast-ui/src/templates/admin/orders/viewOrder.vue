<script setup>
import NavBar from "../../../components/NavBar.vue";
</script>

<script>
import emitter from "./../../../assets/js/emitter";
import {
  getAllOrders,
  deleteOrder,
  getQuery
} from "./../../../assets/js/adminHelper";
export default {
  data() {
    return {
      user: {},
      allOrders: [],
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
    async setPageData() {},
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
    <h1 class="uk-text-center">Ver detalle pedido {{ orderDetailsId }}</h1>
    <div class="uk-container">
      <button class="uk-position-center uk-button uk-button-small uk-button-secondary" @click="setPageData()">Recargar pedidos</button>
    </div>
    <br>
    <div class="uk-container">
      <table
        class="items-table uk-table uk-table-divider uk-table-striped uk-table-hover"
      >
        <thead>
          <tr>
            <th>ID</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th>ID Usuario</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody :key="allOrders">
          <tr v-for="order in allOrders" :key="order.id" :id="order.id">
            <td><b>{{ order.id }}</b></td>
            <td>{{ order.precio_total }}</td>
            <td>{{ order.estado }}</td>
            <td>{{ order.fecha }}</td>
            <td>{{ order.id_usuario }}</td>
            <td>
              <button class="uk-button uk-button-small uk-button-secondary">
                Detalle / Editar</button
              ><button
                class="uk-button uk-button-small uk-button-danger"
                @click="deletePedido(order.id)"
              >
                Eliminar
              </button>
              <button
                class="uk-button uk-button-small uk-button-primary"
                @click=""
                v-if="order.estado == 'en proceso'"
              >
                Terminado
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>
</template>

<style scoped></style>
