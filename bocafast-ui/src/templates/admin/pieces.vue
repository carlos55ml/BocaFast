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
      piecesElements: []
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
      this.$nextTick(() => {
        this.initSearchBox()
      })
    },
    async setPageData() {
      this.allPieces = await getAllPieces();
    },
    initSearchBox() {
      $('input#search-input').on('input', () => {
        let searchTerm = $('input#search-input').val()
        this.$refs.pieces.forEach(element => {
          let title = element.querySelector('h3#pieceTitle').textContent.toLowerCase();
          if(title.includes(searchTerm)) element.style.display = 'flex';
          else element.style.display = 'none';
        });
      })
    }
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
    <div class="uk-form-controls uk-form-controls-text uk-form-horizontal">
      <div>
        <label for="search-input" class="uk-form-label">Busqueda:</label>
        <input ref="searchBox" type="text" class="uk-input" name="search-input" id="search-input">
      </div>
    </div>
    <br>
    <div class="uk-container" :key="allPieces">
      <div ref="pieces" v-for="item in allPieces" class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
        <div class="uk-card-media-left uk-cover-container">
          <img :src="item.imagen" width="300" height="300" alt="" uk-cover/>
          <canvas width="300" height="300"></canvas>
        </div>
        <div class="uk-card-body">
          <h3 id="pieceTitle" class="uk-card-title"><b>{{ item.nombre }}</b></h3>
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
