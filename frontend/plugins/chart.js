import Vue from 'vue'
import { Bar } from 'vue-chartjs'

Vue.component('bar', {
  extends: Bar,
  props: ['data', 'options'],
  mounted() {
    this.renderChart(this.data, this.options)
  },
})
