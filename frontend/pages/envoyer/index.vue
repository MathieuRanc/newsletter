<template>
  <div>
    <h1>Envoyer une newsletter</h1>
    <h2>
      Envoi d'une newsletter
      <span v-if="form.list">à la liste {{ form.list }}</span>
    </h2>
    <p>
      <i
        >La liste 'test' envoie un mail à l'adresse dev@mathieuranc.fr et à
        l'adresse contact@lmlccommunication.fr</i
      >
    </p>
    <form @submit.prevent="preview" enctype="multipart/form-data">
      <label for="list">Liste</label>
      <div class="select">
        <select v-model="form.list" name="list" id="list" required>
          <option value="" disabled>Sélectionnez une liste de diffusion</option>
          <option v-for="(table, i) in content" :key="i" :value="table.name">
            {{ table.name }}
          </option>
        </select>
        <font-awesome-icon icon="chevron-down" />
      </div>
      <label for="from">Nom</label>
      <input
        v-model="form.name"
        type="text"
        name="from"
        id="from"
        placeholder="Entrez un nom représentant l'émetteur de la newsletter"
        required
      />
      <label for="subject">Objet</label>
      <input
        v-model="form.subject"
        type="text"
        name="subject"
        id="subject"
        placeholder="Entrez un objet"
        required
      />
      <label for="description">Description</label>
      <textarea
        v-model="form.description"
        name="description"
        id="description"
        cols="30"
        rows="10"
        required
        placeholder="Entrez une description"
      ></textarea>
      <label for="image">Image</label>
      <input
        type="file"
        name="image"
        id="image"
        accept="image/*"
        placeholder="Sélectionnez une image qui sera envoyée comme message principal"
        required
      />
      <input type="submit" value="Aperçu" name="submit" />
    </form>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  data() {
    return {
      form: { list: '' },
    }
  },
  methods: {
    preview() {
      console.log(process.env.MAILER_URL)
      var formData = new FormData()
      var imagefile = document.querySelector('#image')
      formData.append('image', imagefile.files[0])
      this.$axios
        .post(process.env.API_URL + '/upload', formData, {
          headers: { 'Content-Type': 'multipart/form-data' },
        })
        .then((res) => {
          let mail = { ...this.form }
          mail.image = res.data.url
          console.log(mail)
          this.$store.commit('setMail', mail)
          this.$router.push('/envoyer/apercu')
        })
    },
  },
  computed: mapState({
    content(state) {
      return state.content
    },
  }),
}
</script>

<style lang="scss" scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
