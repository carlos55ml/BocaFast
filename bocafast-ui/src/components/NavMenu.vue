<script>
import axios from "axios";
import { getToken, deleteToken } from "../assets/js/cookies";
import { isString } from "@vue/shared";

export default {
  data() {
    return {
      logged: false,
    };
  },
  mounted() {
    this.isLogged();
  },
  methods: {
    isLogged() {
      axios
        .get("http://api.bocafast.io/get/user/session.php", {
          headers: {
            auth_token: getToken(),
          },
        })
        .then((res) => {
          console.log("logged: ", res);
          res.data.id ? this.logged = true : this.logged = false;
          console.log("loggeado>? ", this.logged)
        })
        .catch((err) => {
          console.error(err);
        });
    },
    logout() {
      deleteToken()
      location.reload()
      // axios
      //   .get("http://api.bocafast.io/get/user/logout.php")
      //   .then((res) => {
      //     console.log(res);
      //     window.location.replace("/");
      //   })
      //   .catch((err) => {
      //     console.error(err);
      //   });
    },
  },
};
</script>
<template>
  <li v-if="logged"><a href="#">Mi perfil</a></li>
  <li v-if="logged"><a href="#">Mis pedidos</a></li>
  <li v-if="logged"><a @click="logout">Cerrar sesion</a></li>
  <li v-if="!logged"><a href="/login.html">Iniciar sesion</a></li>
  <li v-if="!logged"><a href="#">Registrarse</a></li>
</template>
