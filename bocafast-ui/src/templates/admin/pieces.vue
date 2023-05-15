<script setup>
import NavBar from "../../components/NavBar.vue";
</script>

<script>
import emitter from "./../../assets/js/emitter";
import { getAllPieces } from "./../../assets/js/adminHelper";
export default {
  data() {
    return {
      user: {},
      allPieces: [],
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
      this.setPageData();
    },
    async setPageData() {
      this.allPieces = await getAllPieces();
    },
  },
};
</script>

<template>
  <NavBar></NavBar>

  <main class="uk-container uk-align-center" v-if="user && user.admin">
    <h1 class="uk-text-center">BOCATAS</h1>
    <div class="uk-container">
      <button
        class="uk-position-center uk-button uk-button-small uk-button-secondary"
        @click="setPageData()"
      >
        Recargar Bocatas
      </button>
    </div>
    <br />
    <div class="uk-container">
      <div :key="allPieces" v-for="item in allPieces" class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
        <div class="uk-card-media-left uk-cover-container">
          <img :src="item.imagen" width="300" height="300" alt="" uk-cover/>
          <canvas width="300" height="300"></canvas>
        </div>
        <div class="uk-card-bodyq">
          <h3 class="uk-card-title"><b>{{ item.nombre }}</b></h3>
          <p>{{ item.descripcion }}</p>
          <p>
            <u>Igredientes:</u><br>
            {{ item.ingredientes }}
          </p>
          <span>Precio: <b>{{ item.precio }}€</b></span>
        </div>
      </div>
    </div>
  </main>
</template>

<style scoped></style>
