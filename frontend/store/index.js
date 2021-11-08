export const state = () => ({
  content: null,
  tables: { listes: [] },
  selectedTable: null,
  mail: {
    list: null,
    name: null,
    subject: null,
    description: null,
    image: null,
  },
})

export const mutations = {
  setContent(state, content) {
    state.content = content
    // .sort((a, b) => {
    //   if (a.name < b.name) return 1
    //   else if (a.name > b.name) return -1
    //   else return 0
    // })
  },
  setTables(state, tables) {
    state.tables = tables
  },
  setSelectedTable(state, table) {
    state.selectedTable = table
  },
  setMail(state, mail) {
    state.mail = mail
  },
}

export const getters = {
  isAuthenticated(state) {
    return state.auth.loggedIn
  },

  loggedInUser(state) {
    return state.auth.user
  },
}
