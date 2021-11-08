<template>
  <div>
    <div class="logo">N.</div>
    <form @submit.prevent="onSubmit">
      <h1>Login</h1>
      <label for="username">Nom d'utilisateur</label>
      <input
        v-model="login.username"
        type="text"
        name="username"
        id="username"
        autocomplete="on"
      />
      <label for="password">Mot de passe</label>
      <input
        v-model="login.password"
        type="password"
        name="password"
        id="password"
        autocomplete="on"
      />
      <input type="submit" value="Se connecter" />
    </form>
  </div>
</template>

<script>
export default {
  layout: 'login',
  data() {
    return {
      login: {},
    }
  },
  methods: {
    async onSubmit() {
      try {
        await this.$axios
          .$post(process.env.API_URL + '/login', this.login)
          .then((res) => {
            this.$auth.strategy.token.set(res.access_token)
            this.$router.push('/')
          })
          .catch((err) => console.log(err))
      } catch (err) {
        console.log(err)
      }
      this.login.password = null
    },
  },
}
</script>

<style lang="scss" scoped>
.logo {
  font-size: 60px;
  font-weight: bold;
  text-align: center;
}
form {
  margin: 50px auto 0 auto;
  max-width: 500px;
}
</style>
