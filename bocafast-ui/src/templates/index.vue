<script setup>
import NavBar from "../components/NavBar.vue";
</script>

<script>
import emitter from "./../assets/js/emitter";
import { getAllPieces } from "./../assets/js/adminHelper";

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
    });
    this.setPageData();
  },
  methods: {
    async setPageData() {
      this.allPieces = await getAllPieces();
    },
  },
};
</script>

<template>
  <NavBar></NavBar>

  <main>
    <div class="uk-container uk-align-center">
      <h1 class="uk-text-center">
        Bienvenido a Boca<span style="color: red">Fast</span
        ><span v-if="user">, {{ user.username }}</span>
      </h1>
    </div>
    <div class="uk-container">
      <h2 class="uk-text-center">
        <span style="color: red">Nuestros</span> productos:
      </h2>
    </div>
    <div class="uk-slider-container-offset uk-height-1-2" uk-slider="autoplay: true">
      <div
        class="uk-position-relative uk-visible-toggle uk-dark"
        tabindex="-1"
      >
        <ul class="uk-slider-items uk-child-width-1-4@s uk-grid">
          <li v-for="item in allPieces">
            <div class="uk-card uk-card-default">
              <div class="uk-card-media-top">
                <img :src="item.imagen" width="300" height="300" alt="" />
              </div>
              <div class="uk-card-body">
                <h3 class="uk-card-title"><b>{{ item.nombre }}</b></h3>
                <p>
                  {{item.descripcion}}
                </p>
              </div>
            </div>
          </li>
        </ul>

        <a
          class="uk-position-center-left uk-position-small"
          href="#"
          uk-slidenav-previous
          uk-slider-item="previous"
        ></a>
        <a
          class="uk-position-center-right uk-position-small"
          href="#"
          uk-slidenav-next
          uk-slider-item="next"
        ></a>
      </div>

      <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>
    </div>
  </main>
</template>

<style scoped></style>
