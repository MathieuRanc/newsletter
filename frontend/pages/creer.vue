<template>
  <div>
    <h1>Créer une newsletter</h1>
    <form @submit.prevent="create">
      <input
        v-model="list"
        type="text"
        name="list"
        id="list"
        placeholder="Nom de la newsletter"
        required
      />
      <input type="submit" value="Créer une newsletter" />
    </form>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  data() {
    return {
      list: null,
    }
  },
  methods: {
    async create() {
      await this.$axios.$post(process.env.API_URL + '/creation', {
        list: this.list,
      })
    },
  },
}
</script>

<style lang="scss" scoped></style>
