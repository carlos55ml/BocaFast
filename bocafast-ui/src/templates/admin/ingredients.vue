<script setup>
import NavBar from "../../components/NavBar.vue";
import { getCurrentInstance } from 'vue';
</script>

<script>
import emitter from "./../../assets/js/emitter";
import {
  getAllIngredients,
  deleteIngredient,
} from "./../../assets/js/adminHelper";
export default {
  data() {
    return {
      user: {},
      allIngredients: [],
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
      this.allIngredients = await getAllIngredients();
    },
    async deleteIngrediente(ingredientId) {
      let confirmDelete = confirm(`¿Está seguro que desea borrar el item con id ${ingredientId}?`);
      if (confirmDelete) {
        let res = await deleteIngredient(ingredientId);
        if(res>0) this.setPageData()
      }
    }
  },
};
</script>

<template>
  <NavBar></NavBar>

  <main class="uk-container uk-align-center" v-if="user && user.admin">
    <h1 class="uk-text-center">Ingredientes</h1>
    <div class="uk-container">
      <button class="uk-position-center uk-button uk-button-small uk-button-secondary" @click="setPageData()">Recargar ingredientes</button>
    </div>
    <br>
    <div class="uk-container">
      <table
        class="items-table uk-table uk-table-divider uk-table-striped uk-table-hover"
      >
        <thead>
          <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>URL imagen</th>
            <th>Precio unidad</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody :key="allIngredients">
          <tr v-for="item in allIngredients" :key="item.id" :id="item.id">
            <td>{{ item.id }}</td>
            <td>{{ item.nombre }}</td>
            <td>{{ item.cantidad }}</td>
            <td>{{ item.imagen }}</td>
            <td>{{ item.precio_unidad }}</td>
            <td>
              <button class="uk-button uk-button-small uk-button-secondary">
                Modificar</button
              ><button
                class="uk-button uk-button-small uk-button-danger"
                @click="deleteIngrediente(item.id)"
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
