<template>
  <div>
    <div>
      <h3 style="margin-left:200px; margin-top:50px">1. Thống kê doanh thu từng tháng</h3>
      <div style="width: 800px; display:block; margin:0 auto;">
        <Bar style="width: 800px" :chart-options="doanhthu.chartOptions" :chart-data="doanhthu.chartData"
          :chart-id="doanhthu.chartId" :dataset-id-key="doanhthu.datasetIdKey" :plugins="doanhthu.plugins"
          :css-classes="doanhthu.cssClasses" :styles="doanhthu.styles" :width="doanhthu.width"
          :height="doanhthu.height" />
      </div>
      <label style="margin-left:600px ;margin-top:100px" for="start">Chọn mốc thời gian:</label>

      <input v-model="time" style="margin-left:100px" type="month" id="start" name="start" min="2018-03"
        value="2022-05">
      <el-button style="margin-left:20px" @click="getDetailTurnover">Lọc</el-button>





      <el-table style="margin-top:30px;margin-left:300px;" v-loading="listLoading" :data="list"
        element-loading-text="Loading">
        <el-table-column align="center" label="ID" width="95">
          <template slot-scope="scope">
            {{ scope.$index + 1 }}
          </template>
        </el-table-column>
        <el-table-column align="center" label="Name" width="200">
          <template slot-scope="scope">
            {{ scope.row.name }}
          </template>
        </el-table-column>
        <el-table-column align="center" label="Start Date" width="200">
          <template slot-scope="scope">
            <span>{{ scope.row.start_date.slice(0, 10) }}</span>
          </template>
        </el-table-column>
        <el-table-column align="center" label="Range" width="200">
          <template slot-scope="scope">
            <span>{{ scope.row.range }}</span>
          </template>
        </el-table-column>
        <el-table-column align="center" label="Max Slot" width="200">
          <template slot-scope="scope">
            <span>{{ scope.row.max_slot }}</span>
          </template>
        </el-table-column>
        <el-table-column align="center" label="Slot" width="200">
          <template slot-scope="scope">
            <span>{{ scope.row.slot }}</span>
          </template>
        </el-table-column>
        <el-table-column align="center" label="Turnover" width="200">
          <template slot-scope="scope">
            <span>{{ scope.row.total }}</span>
          </template>
        </el-table-column>


      </el-table>




    </div>
    <div>
      <h3 style="margin-left:200px; margin-top:50px">2. Biểu đồ phân bố category</h3>
      <div style="width: 800px; display:block; margin:0 auto;">

        <Bar style="width: 800px" :chart-options="category.chartOptions" :chart-data="category.chartData"
          :chart-id="category.chartId" :dataset-id-key="category.datasetIdKey" :plugins="category.plugins"
          :css-classes="category.cssClasses" :styles="category.styles" :width="category.width"
          :height="category.height" />
        <br>
      </div>
    </div>


  </div>

</template>

<script>
import { Bar, Pie } from 'vue-chartjs/legacy'
import {
  getTurnover,
  getAllCategories,
  getDetailTurnover,
  getListTour
} from "@/api/tour";
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'


ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)
export default {
  name: "thongke",
  components: {
    Bar, Pie
  },
  created() {

    this.fetchData()

  },
  methods: {
    convertTime(time) {
      return time.split('-');
    },
    getDetailTurnover() {
      getDetailTurnover(this.time.split('-')[0], this.time.split('-')[1]).then((res) => {
        this.listLoading = true
        // this.time = data[0];
        this.list = res.data.detail;
        console.log(this.list);
        this.listLoading = false

      })
    },
    getAllCategories() {
      getAllCategories().then((response) => {
        let data = response.data;
        for (let i = response.total - 1; i >= 0; i--) {
          this.category.chartData.datasets[0].data.push(data[i].count);
          this.category.chartData.labels.push(data[i].name);
        }
        // console.log(999, data);
      });
    },
    getTurnover() {
      getTurnover().then((response) => {
        let data = response.data;
        for (let i = data.length - 1; i >= 0; i--) {
          this.doanhthu.chartData.datasets[0].data.push(data[i].total.total_month);
          this.doanhthu.chartData.labels.push(data[i].time);
        }
      });
    },
    async fetchData() {
      this.getAllCategories();
      this.getTurnover();
      this.getDetailTurnover();

    },
  },
  data() {
    return {
      time: "2022-08",
      list: [],
      listLoading: true,
      // $data: [],
      doanhthu: {
        chartId: 'bar-chart',
        datasetIdKey: 'label',
        width: 400,
        height: 400,
        cssClasses: '',
        styles: () => { },
        plugins: () => { },
        chartData: {
          labels: [],
          datasets: [{
            data: [],
            borderColor: "green",
            pointBackgroundColor: "white",
            borderWidth: 1,
            pointBorderColor: "white",
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(201, 203, 207, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
            ],
            label: "Doanh thu 12 tháng qua",
          }]
        },
        chartOptions: {
          scales: {
            x: {
              title: {
                display: true,
                text: 'Thời gian'
              }
            },
            y: {
              label: 'ok',
              title: {
                display: true,
                text: 'Doanh thu (VND)'
              },
              suggestedMin: 50,
              suggestedMax: 100
            }
          },
          legend: {
            display: false
          },
          tooltips: {
            enabled: true,
            mode: 'single',
            callbacks: {
              label: function (tooltipItems, data) {
                return '$' + tooltipItems.yLabel;
              }
            }
          },
          responsive: true,
          maintainAspectRatio: false,
          height: 200
        }
      },
      category: {
        chartId: 'pie-chart',
        datasetIdKey: 'label09',
        width: 400,
        height: 400,
        cssClasses: '',
        styles: () => { },
        plugins: () => { },
        chartData: {
          labels: [],
          datasets: [{
            data: [],
            borderColor: "green",
            pointBackgroundColor: "white",
            borderWidth: 1,
            pointBorderColor: "white",
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(201, 203, 207, 0.2)',
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
            ],
            label: "Phân bố category",
          }]
        },
        chartOptions: {
          scales: {
            y: {
              label: 'ok',
              stepSize: 1,
              title: {
                display: true,
                text: 'Số lượng'
              },
              ticks: {
                // forces step size to be 50 units
                stepSize: 1
              }

              // suggestedMin: 50,
              // suggestedMax: 100
            },
            x: {
              label: 'ok',
              stepSize: 1,
              title: {
                display: true,
                text: 'Category'
              },
              ticks: {
                // forces step size to be 50 units
                stepSize: 1
              }

              // suggestedMin: 50,
              // suggestedMax: 100
            }
          },
          legend: {
            display: false
          },
          tooltips: {
            enabled: true,
            mode: 'single',
            callbacks: {
              label: function (tooltipItems, data) {
                return '$' + tooltipItems.yLabel;
              }
            }
          },
          responsive: true,
          maintainAspectRatio: false,
          height: 200
        }
      },
    }
  }
}
</script>