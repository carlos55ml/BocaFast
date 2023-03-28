<script setup>
import NavBar from '../components/NavBar.vue';

</script>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      users: []
    };
  },
  mounted() {
    this.fetchUsers();
  },
  methods: {
    fetchUsers() {
      axios.get('http://api.bocafast.io/get/user/users.php')
        .then(res => {
          // console.log(res)
          this.users = res.data;
        })
        .catch(err => {
          console.error(err);
        })
    }
  }
}
</script>

<template>
  <NavBar></NavBar>

  <main>
    <h1>Pedir</h1>
    <table>
      <thead>
        <tr>
          <th>id</th>
          <th>username</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" :key="user.id">
          <td>{{ user.id }}</td>
          <td>{{ user.username }}</td>
        </tr>
      </tbody>
    </table>

  </main>
</template>

<style scoped>

</style>

