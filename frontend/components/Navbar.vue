<template>
  <nav>
    <NuxtLink to="/"> N. </NuxtLink>
    <NuxtLink to="/envoyer">
      <font-awesome-icon icon="paper-plane" />
      Envoyer
    </NuxtLink>
    <NuxtLink to="/creer">
      <font-awesome-icon icon="plus-square" />
      Créer
    </NuxtLink>
    <NuxtLink to="/ajouter">
      <font-awesome-icon icon="user-plus" />
      Ajouter
    </NuxtLink>
    <NuxtLink to="/supprimer">
      <font-awesome-icon icon="user-minus" />
      Supprimer
    </NuxtLink>
    <NuxtLink to="/stastistiques">
      <font-awesome-icon icon="chart-line" />
      Stastistiques
    </NuxtLink>
    <NuxtLink to="/reglages">
      <font-awesome-icon icon="cog" />
      Réglages
    </NuxtLink>
  </nav>
</template>

<script>
export default {}
</script>

<style lang="scss" scoped>
nav {
  position: -webkit-sticky;
  position: sticky;
  top: 0;
  min-height: 100vh;
  border-right: solid 1px black;

  margin-bottom: auto;
  display: flex;
  flex-direction: column;
  a {
    min-width: 180px;
    color: black;
    text-decoration: none;
    padding: 10px 20px;
    margin: 10px 0;
    transition: border-left 400ms;
    border-left: 0px transparent solid;

    svg {
      margin-right: 10px;
    }
    &:first-child {
      font-size: 40px;
      font-weight: bold;
      text-align: center;
      transition: transform 200ms;
      &:hover {
        transform: scale(1.1);
      }
    }
    &.nuxt-link-exact-active:not(:first-child) {
      border-left: 6px black solid;
    }
  }
}
</style>
