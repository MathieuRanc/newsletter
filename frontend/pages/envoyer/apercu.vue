<template>
  <div>
    <h1>Apperçu</h1>
    <div>À : {{ mail.list }}</div>
    <div>De : {{ mail.name }}</div>
    <div>Objet : {{ mail.subject }}</div>
    <div>Description : {{ mail.description }}</div>
    <img :src="mail.image" alt="" />
    <NuxtLink to="/envoyer">Annuler</NuxtLink>
    <button @click="send">Envoyer</button>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  computed: mapState({
    mail(state) {
      return state.mail
    },
  }),
  methods: {
    send() {
      this.$axios.$post(process.env.API_URL + '/send', this.mail)
    },
  },
}
</script>

<style lang="scss" scoped>
img {
  max-width: 100%;
}
</style>
