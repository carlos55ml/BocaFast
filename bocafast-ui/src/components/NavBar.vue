<script setup>
import NavMenu from '../components/NavMenu.vue';

</script>
<script>
import './../assets/css/NavBar.css';
import emitter from './../assets/js/emitter'
const location = window.location.pathname;
const locations = {
  'Inicio' : '/',
  'Bocatas': '/bocatas.html',
  'Pedir': '/pedido.html'
}
const adminLocations = {
  'Administrar' : '/admin/'
}
export default {
  data() {
    return {
      windowLocation: location,
      user: {}
    };
  },
  mounted() {
    this.setActive()
    emitter.on('userObj', userObj =>{ this.user = userObj; this.isAdmin() })
    
  },
  methods: {
    setActive() {
      let navPages = "";
      Object.entries(locations).forEach(([k, v]) => {
        if (location == v) {
          navPages += `<li class='uk-active'><a href="${v}">${k}</a></li>`
        } else {
          navPages += `<li><a href="${v}">${k}</a></li>`
        }
      })
      $('#navPages').append(navPages)
    },
    isAdmin() {
      let navPages = ''
      if (this.user && this.user.admin) {
        Object.entries(adminLocations).forEach(([k, v]) => {
          if (location == v) {
            navPages += `<li class='uk-active'><a href="${v}">${k}</a></li>`
          } else {
            navPages += `<li><a href="${v}">${k}</a></li>`
          }
        })
        $('#navPages').append(navPages)
      }
    }
    
  }
}
</script>

<template>
  <nav class="uk-navbar-container" id="navbar" uk-navbar>
    <a class="uk-navbar-item uk-logo" href="/" aria-label="Back to Home"><span>Boca<span style="color: red">Fast</span></span></a>
    <div class="uk-navbar-center" >
      <ul class="uk-navbar-nav" id="navPages">
      </ul>
    </div>
    <div class="uk-navbar-right">
      <a class="uk-navbar-toggle uk-navbar-toggle-animate" uk-navbar-toggle-icon href="#"></a>
      <div class="uk-navbar-dropdown">
        <ul class="uk-nav uk-navbar-dropdown-nav">
          <NavMenu />
        </ul>
      </div>
    </div>
  </nav>
</template>