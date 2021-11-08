<template>
  <div>
    <h1>Ajouter des adresses</h1>
    <form @submit.prevent="onSubmit">
      <label for="list">Newsletter</label>
      <div class="select">
        <select v-model="list" name="list" id="list" required>
          <option v-for="(name, i) in tables.listes" :key="i" :value="name">
            {{ name }}
          </option>
        </select>
        <font-awesome-icon icon="chevron-down" />
      </div>
      <label for="emails">Adresses</label>
      <textarea
        v-model="emails"
        type="text"
        name="emails"
        id="emails"
        rows="10"
        required
      />
      <input v-if="state !== 'progress'" type="submit" value="Ajouter" />
      <input v-else type="submit" value="Ajouter" disabled />
      <span v-if="state === 'progress'">Ajout en cours</span>
      <span v-else-if="fail === 0">Ajouté avec succès</span>
      <span v-else
        >{{ success }} ajouté<span v-if="success > 1">s</span>, {{ fail }}
        <span v-if="fail < 2">echec d'ajout</span
        ><span v-else>echecs d'ajouts</span></span
      >
    </form>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  data() {
    return {
      list: null,
      emails: null,
      state: 'initial',
      success: 0,
      fail: 0,
    }
  },
  methods: {
    onSubmit() {
      var emails = this.emails.split('\n')
      this.state = 'progress'
      this.success = 0
      this.fail = 0
      emails.forEach(async (email) => {
        await this.$axios
          .$get(process.env.API_URL + '/inscription', {
            params: { email, list: this.list },
          })
          .then(() => (this.success = this.success + 1))
          .catch(() => (this.fail = this.fail + 1))
      })
      this.state = 'added'
    },
  },
  computed: mapState({
    tables(state) {
      return state.tables
    },
  }),
}
</script>

<style lang="scss" scoped></style>
