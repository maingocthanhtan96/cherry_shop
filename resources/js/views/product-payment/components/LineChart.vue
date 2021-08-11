<template>
  <div :class="className" :style="{ height: height, width: width }" />
</template>

<script>
import * as echarts from 'echarts';
import { debounce } from '@/utils';

export default {
  props: {
    className: {
      type: String,
      default: 'chart',
    },
    width: {
      type: String,
      default: '100%',
    },
    height: {
      type: String,
      default: '350px',
    },
    autoResize: {
      type: Boolean,
      default: true,
    },
    chartData: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      chart: null,
    };
  },
  watch: {
    chartData: {
      deep: true,
      handler(val) {
        this.setOptions(val);
      },
    },
  },
  mounted() {
    this.init();
    if (this.autoResize) {
      this.__resizeHandler = debounce(() => {
        if (this.chart) {
          this.chart.resize();
        }
      }, 1000);
      window.addEventListener('resize', this.__resizeHandler);
    }
  },
  methods: {
    init() {
      this.chart = echarts.init(this.$el);
    },
    setOptions({ date, value } = {}) {
      this.chart.setOption({
        dataZoom: [
          {
            type: 'slider',
          },
        ],
        legend: {
          data: [this.$t('table.product_payment.total_sold')],
        },
        tooltip: {
          trigger: 'axis',
        },
        xAxis: [
          {
            data: date,
            axisLabel: { rotate: 50 },
          },
        ],
        yAxis: [{}],
        grid: [
          {
            top: 30,
            containLabel: true,
          },
        ],
        series: [
          {
            type: 'line',
            name: this.$t('table.product_payment.total_sold'),
            data: value,
            smooth: true,
            animationDuration: 2800,
            animationEasing: 'cubicInOut',
          },
        ],
      });
    },
  },
};
</script>

<style></style>
