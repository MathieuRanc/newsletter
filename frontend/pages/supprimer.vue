<template>
  <div>
    <h1>Supprimer des adresses</h1>
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
      <input v-if="state !== 'progress'" type="submit" value="Supprimer" />
      <input v-else type="submit" value="Supprimer" disabled />
      <span v-if="state === 'progress'">Suppression en cours</span>
      <span v-else-if="fail === 0">Supprimé avec succès</span>
      <span v-else
        >{{ success }} supprimé<span v-if="success > 1">s</span>,
        {{ fail }} echec de suppression<span v-if="fail > 1">s</span></span
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
          .$get(process.env.API_URL + '/desinscription', {
            params: { email, list: this.list },
          })
          .then(() => (this.success = this.success + 1))
          .catch(() => (this.fail = this.fail + 1))
      })
      this.state = 'deleted'
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
