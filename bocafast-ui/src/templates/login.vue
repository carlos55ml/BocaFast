<script setup>
import NavBar from "../components/NavBar.vue";
</script>

<script>
import axios from "axios";
import { saveToken } from "./../assets/js/cookies"


export default {
  data() {
    return {
      users: [],
    };
  },
  mounted() {
    this.fetchUsers();

    /**
     * Login Form Event
     */
    $("#loginForm").submit((event) => {
      event.preventDefault();
      axios
        .post(
          "http://api.bocafast.io/helpers/session/sessionLogin.php",
          {
            username: $("#username").val(),
            password: $("#password").val(),
          },
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        )
        .then((response) => {
          console.log(response.data);
          saveToken(response.data.session_token)

          window.location.pathname = "/";
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    });
  },
  methods: {
    fetchUsers() {
      axios
        .get("http://api.bocafast.io/get/user/users.php")
        .then((res) => {
          this.users = res.data;
        })
        .catch((err) => {
          console.error(err);
        });
    },
  },
};
</script>

<template>
  <NavBar></NavBar>

  <main>
    <div
      class="uk-section uk-section-muted uk-flex uk-flex-middle"
      uk-height-viewport
      style="padding-top: 0px"
    >
      <div class="uk-width-1-1">
        <div class="uk-container">
          <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
            <div class="uk-width-1-1@m">
              <div
                class="uk-margin uk-width-large uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large"
              >
                <h3 class="uk-card-title uk-text-center">Inicia sesion.</h3>
                <form id="loginForm">
                  <div class="uk-margin">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon" uk-icon="mail"></span>
                      <input
                        class="uk-input uk-form-large"
                        name="username"
                        id="username"
                        type="text"
                        placeholder="Usuario"
                      />
                    </div>
                  </div>
                  <div class="uk-margin">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon" uk-icon="icon: lock"></span>
                      <input
                        class="uk-input uk-form-large"
                        name="password"
                        id="password"
                        type="password"
                        placeholder="Contraseña"
                      />
                    </div>
                  </div>
                  <div class="uk-margin">
                    <button
                      type="submit"
                      class="uk-button uk-button-primary uk-button-large uk-width-1-1"
                    >
                      Login
                    </button>
                  </div>
                  <div class="uk-text-small uk-text-center">
                    No tienes cuenta? <a href="#">Registrate aqui</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<style scoped></style>
