<template>
  <div>
    <h1>Réglages</h1>
    <button @click="logout">Déconnection</button>
    <h2>A implémenter</h2>
    <ul>
      <li>Réinitialisation mdp le mot de passe</li>
      <li>Se déconnecter</li>
      <li>Mode sombre</li>
    </ul>
  </div>
</template>

<script>
export default {
  methods: {
    async logout() {
      await this.$auth.strategy.token.reset()
      this.$router.push('/login')
    },
  },
}
</script>

<style lang="scss" scoped></style>
