<script setup>
import NavBar from "./../../../components/NavBar.vue";
</script>

<script>
import emitter from "./../../../assets/js/emitter";
import {getQuery, getPieceById} from "./../../../assets/js/adminHelper";
import axios from "axios";
export default {
  data() {
    return {
      user: {},
      img: null,
      targetPiece: null,
      pieceData: null
    };
  },
  mounted() {
    emitter.on("userObj", (userObj) => {
      this.user = userObj;
      this.checkAdmin();
    });
    
    this.targetPiece = getQuery("pieceId")
    this.setPageData(this.targetPiece);
  },
  methods: {
    checkAdmin() {
      if (!this.user || !this.user.admin == 1) {
        alert("Necesitas ser administrador para ver esta pagina.");
        window.location = "/";
      }
    },
    handleImageUpload(event) {
      this.img = event.target.files[0];
    },
    async setPageData(target) {
      this.pieceData = await getPieceById(target);
      if(this.pieceData) {
        $("input#nombreBocata").val(this.pieceData[1])
        $("input#ingredientesBocata").val(this.pieceData[2])
        $("input#precioBocata").val(this.pieceData[3])
        $("textarea#descripcionBocata").val(this.pieceData[5])
      }
    },
    submitForm(event) {
      event.preventDefault();
      if(this.targetPiece) modifyPiece(this.targetPiece);
      else this.createNewPiece();
    },
    modifyPiece(targetPiece) {

    },
    createNewPiece() {
      axios.post('http://api.bocafast.io/set/pieces/createPiece.php',
      {
        nombreBocata: $("input#nombreBocata").val(),
        ingredientesBocata: $("input#ingredientesBocata").val(),
        precioBocata: $("input#precioBocata").val(),
        descripcionBocata: $("textarea#descripcionBocata").val(),
        imagenBocata: this.img
      },
      {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      }).then((res) => {
        console.log(res.data)
        })
        .catch((error) => {
          return;
        });
    }
  },
};
</script>

<template>
  <NavBar></NavBar>

  <main
    class="uk-container uk-align-center"
    v-if="user && user.admin"
    :key="user"
  >
    <h1 class="uk-text-center">Nuevo Bocata</h1>

    <form id="bocataForm" @submit="submitForm">
        <div class="uk-margin">
          <label for="nombreBocata">Nombre</label>
          <input
            class="uk-input"
            name="nombreBocata"
            id="nombreBocata"
            type="text"
            placeholder="Nombre Bocata"
          />
        </div>
        <div class="uk-margin">
          <label for="ingredientesBocata">Ingredientes</label>
          <input
            class="uk-input"
            name="ingredientesBocata"
            id="ingredientesBocata"
            type="text"
            placeholder="Ingredientes Bocata"
          />
        </div>
        <div class="uk-margin">
          <label for="precioBocata">Precio: </label>
          <input
            class="uk-input uk-form-width-small"
            name="precioBocata"
            id="precioBocata"
            type="number"
            placeholder="Precio"
          />
          €
        </div>
        <div class="uk-margin">
          <label for="descripcionBocata">Descripcion</label>
          <textarea
            id="descripcionBocata"
            name="descripcionBocata"
            class="uk-textarea"
            rows="3"
            placeholder="Breve descripcion del bocata"
          ></textarea>
        </div>
        <div class="uk-margin">
          <div uk-form-custom="target: true">
            <label for="">Imagen: </label>
            <input @change="handleImageUpload" type="file" aria-label="Custom controls" />
            <input
              class="uk-input uk-form-width-medium"
              type="text"
              placeholder="Elige imagen"
              aria-label="Custom controls"
              disabled
            />
          </div>
        </div>
        <button type="submit" class="uk-button uk-button-primary uk-width-1-1">
          Guardar
        </button>
    </form>
  </main>
</template>

<style scoped></style>
