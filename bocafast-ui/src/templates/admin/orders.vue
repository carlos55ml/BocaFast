<script setup>
import NavBar from "../../components/NavBar.vue";

</script>

<script>
import emitter from "./../../assets/js/emitter";
import {
  getAllFinishedOrders,
  getAllActiveOrders,
  deleteOrder,
  cancelOrder,
  changeOrderState
} from "./../../assets/js/adminHelper";
export default {
  data() {
    return {
      user: {},
      allActiveOrders: [],
      allFinishedOrders: []
    };
  },
  mounted() {
    emitter.on("userObj", (userObj) => {
      this.user = userObj;
      this.checkAdmin();
    });
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
      this.allActiveOrders = await getAllActiveOrders();
      this.allFinishedOrders = await getAllFinishedOrders();
    },
    async deletePedido(orderId) {
      let confirmDelete = confirm(`¿Está seguro que desea borrar el pedido con id ${orderId}?`);
      if (confirmDelete) {
        let res = await deleteOrder(orderId);
        if(res>0) this.setPageData()
      }
    },
    async cancelarPedido(orderId){
      let confirmDelete = confirm(`¿Está seguro que desea CANCELAR el pedido con id ${orderId}?`);
      if (confirmDelete) {
        let res = await cancelOrder(orderId);
        if(res) this.setPageData()
      }
    },
    viewOrder(orderId) {
      window.location.href = `/admin/orders/viewOrder.html?orderId=${orderId}`;
    },
    async changeState(orderId, state) {
      let newState = state == 1 ? 'en proceso' : 'terminado';
      let confirmChange = confirm(`Seguro que quiere cambiar el estado del pedido ${orderId} a '${newState}'?`);
      if(confirmChange) {
        let res = await changeOrderState(orderId, state)
        if(res) this.setPageData();
      }
    }
  },
};
</script>

<template>
  <NavBar></NavBar>

  <main class="uk-container uk-align-center" v-if="user && user.admin">
    <h1 class="uk-text-center">Pedidos</h1>
    <div class="uk-container">
      <button class="uk-position-center uk-button uk-button-small uk-button-secondary" @click="setPageData()">Recargar pedidos</button>
    </div>
    <br>
    <div class="uk-container">
      <h3>Pedidos Activos</h3>
      <table
        class="items-table uk-table uk-table-divider uk-table-striped uk-table-hover"
      >
        <thead>
          <tr>
            <th>ID</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th>Nombre cliente</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody :key="allActiveOrders">
          <tr v-for="order in allActiveOrders" :key="order.id" :id="order.id">
            <td><b>{{ order.id }}</b></td>
            <td>{{ order.precio_total }}</td>
            <td>{{ order.estado }}</td>
            <td>{{ order.fecha }}</td>
            <td>{{ order.username }}</td>
            <td>
              <button 
                class="uk-button uk-button-small uk-button-secondary"
                @click="viewOrder(order.id)"
                >
                Detalle / Editar</button>
                <button
                class="uk-button uk-button-small uk-button-danger"
                @click="cancelarPedido(order.id)"
              >
                Cancelar
              </button>
              <button
                class="uk-button uk-button-small uk-button-danger"
                @click="changeState(order.id, 2)"
                v-if="order.estado == 'en proceso'"
              >
                Poner: Terminado
              </button>
              <button
                class="uk-button uk-button-small uk-button-primary"
                @click="changeState(order.id, 1)"
                v-if="order.estado == 'recibido'"
              >
                Poner: En proceso
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="uk-container">
      <h3>Pedidos Terminados</h3>
      <table
        class="items-table uk-table uk-table-divider uk-table-striped uk-table-hover"
      >
        <thead>
          <tr>
            <th>ID</th>
            <th>Precio</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th>Nombre Cliente</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody :key="allFinishedOrders">
          <tr v-for="order in allFinishedOrders" :key="order.id" :id="order.id">
            <td><b>{{ order.id }}</b></td>
            <td>{{ order.precio_total }}</td>
            <td>{{ order.estado }}</td>
            <td>{{ order.fecha }}</td>
            <td>{{ order.username }}</td>
            <td>
              <button 
                class="uk-button uk-button-small uk-button-secondary"
                @click="viewOrder(order.id)"
                >
                Detalle</button>
                <button
                class="uk-button uk-button-small uk-button-danger"
                @click="deletePedido(order.id)"
              >
                Eliminar
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>
</template>

<style scoped></style>
