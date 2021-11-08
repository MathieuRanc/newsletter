<template>
  <div>
    <h1>Stastistiques</h1>
    <h2>A prévoir</h2>
    <ul>
      <li>Nombre de newsletter envoyées</li>
      <li>Nombre de newsletter ouverts</li>
      <li>Nombre de personnes inscrites par newsletter</li>
    </ul>
    <h2>Exemple de graphique</h2>
    <div class="chart">
      <client-only>
        <bar :data="chartData" :options="chartOptions"></bar>
      </client-only>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      chartData: {
        labels: [
          'Janvier',
          'Février',
          'Mars',
          'Avril',
          'Mai',
          'Juin',
          'Juillet',
          'Août',
          'Septembre',
          'Décembre',
        ],
        datasets: [
          {
            label: 'Envoyés',
            backgroundColor: '#98A6E5',
            data: [2500, 2700, 3200, 3400, 4000, 0, 0, 0, 0, 0, 0, 0],
          },
          {
            label: 'Ouverts',
            backgroundColor: '#A5DE66',
            data: [2000, 2200, 2500, 3000, 1000, 0, 0, 0, 0, 0, 0, 0],
          },
          {
            label: 'Non envoyés',
            backgroundColor: '#F26C4F',
            data: [100, 200, 50, 20, 10],
          },
        ],
      },
      chartOptions: {
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
              },
            },
          ],
        },
        responsive: true,
        maintainAspectRatio: false,
      },
    }
  },
}
</script>

<style lang="scss" scoped>
.chart {
  max-height: 300px;
}
</style>
