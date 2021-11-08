<template>
  <div v-if="content && tables && tables.listes" id="page">
    <Navbar />
    <Nuxt id="container" />
  </div>
  <div v-else>
    <h1>Erreur de connection</h1>
    <NuxtLink to="/login">Authentification</NuxtLink>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  computed: mapState({
    tables(state) {
      return state.tables
    },
    content(state) {
      return state.content
    },
  }),
  async fetch() {
    if (this.$auth.strategy.token.get()) {
      await this.$axios
        .$get(process.env.API_URL + '/listes')
        .then((res) => this.$store.commit('setTables', res))
        .catch((err) => this.$router.push('/login'))
      let content = []
      // console.log(tables.listes)
      this.$store.state.tables.listes.forEach(async (table) => {
        await this.$axios
          .$get(process.env.API_URL + '/newsletter', {
            params: { list: table },
          })
          .then((res) =>
            content.push({ emails: res.emails, name: table, count: res.count })
          )
        this.$store.commit('setContent', [...content])
      })
    } else {
      this.$router.push('/login')
    }
  },
}
</script>

<style lang="scss">
html {
  scroll-behavior: smooth;
  word-spacing: 1px;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
  overflow-y: scroll;
  max-height: 100vh;
  scroll-snap-type: y proximity;
}
html,
textarea {
  font-family: 'Open Sans', 'Source Sans Pro', -apple-system, BlinkMacSystemFont,
    'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
}
*,
*::before,
*::after {
  box-sizing: border-box;
  margin: 0;
}
#page {
  display: flex;
}
.page-enter-active,
.page-leave-active {
  // scroll-behavior: none;
  transition: opacity 0.2s;
}
.page-enter,
.page-leave-to {
  opacity: 0;
}
#container {
  width: 100%;
  padding: 100px;
}
h1 {
  font-size: 40px;
  margin-bottom: 20px;
}
form {
  margin: 20px 0;
  display: flex;
  flex-direction: column;
  input,
  select,
  textarea {
    &:not(:last-child) {
      margin-bottom: 20px;
    }
  }
  label {
    margin-bottom: 6px;
    font-size: 16px;
    font-weight: bolder;
  }
  input,
  select,
  textarea {
    padding: 10px;
    border: none;
    border-radius: 4px;
    border: solid 1px #888;
  }
  textarea {
    resize: vertical;
  }
  .select {
    position: relative;
    display: flex;
    flex-direction: column;
    select {
      -webkit-appearance: none;
      option[value=''] {
        color: gray;
      }
    }
    select:invalid,
    select option[value=''] {
      color: gray;
    }
    svg {
      position: absolute;
      top: 10px;
      right: 12px;
    }
  }
  input[type='submit'] {
    margin-right: auto;
    border: none;
    background-color: rgb(82, 82, 194);
    color: white;
    padding: 10px 20px;
    border-radius: 4px;
    transition: background-color 200ms;
    cursor: pointer;
    &:hover {
      background-color: rgb(68, 68, 163);
    }
  }
}
</style>
