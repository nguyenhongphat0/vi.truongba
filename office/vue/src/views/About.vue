<template>
  <div class="about">
    <img src="img/logo.png">
    <h5>&copy; Copyright 2018</h5>
    <p>
      Logged as <i>{{username}}</i> (11:25 AM 2015-05-05)<br>
      <a @click="logout" href="#" style="color: #E33333; text-decoration: none">Logout</a>
    </p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      username: localStorage.getItem('username')
    }
  },
  methods: {
    logout() {
      fetch(`/api/user/logout.php`, {credentials: 'include'}).then(res => {
        this.$router.push('/login');
      })
    }
  }
}
</script>


<style lang="scss" scoped>
  .about {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

    p {
      font-size: 12px;
    }
  }
</style>
