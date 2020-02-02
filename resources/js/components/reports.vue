<template>
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">

            <highcharts :options="chartOptions" :constructor-type="'stockChart'"></highcharts>
            <highcharts :options="futurechartOptions" :constructor-type="'stockChart'"></highcharts>

          </div>
        </div>
      </div>
</template>

<script>
import Highcharts from 'highcharts'
import stockInit from 'highcharts/modules/stock'
stockInit(Highcharts)
import {Chart} from 'highcharts-vue'
let sales2 = [  [Date.parse("2020-2-01"), 2   ],
                [Date.parse("2020-2-04"), 3 ],
                [Date.parse("2020-2-08"), 1 ],
                [Date.parse("2020-2-09"), 4 ],
                [Date.parse("2020-2-24"), 5 ],
                [Date.parse("2020-2-29"), 7 ]];
let sales = new Array();
export default {
  components: {
      highcharts: Chart
  },
  data(){
    return {
        reservations:[],
        found:'',
        chartOptions: {
            title: {
                text: 'Recorded Sales'
            },
            subtitle: {
                text: 'reservation data recorded by the system.'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'Sales'
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                type: 'spline',
                color: "#ff2424",
                name: 'Recorded Sale',
                data: sales,
                    }
                ]
        },
        futurechartOptions: {
             chart: {
                type: 'spline',
                animation: {
                    enabled: false
                }
            },
            title: {
                text: 'Forecast Sales'
            },
            subtitle: {
                text: 'Forecast sales from reservation data recorded by the system.'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'Sales'
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                type: 'spline',
                name: 'Forecast Sale',
                data: sales2
                }
                    ]
        }
    }
  },
  mounted () {
        let found;
        let date;
        axios.get('api/reservation').then(({data})=>(
           this.reservations = data.data,
          this.reservations.forEach(element => {
                date = (element) => element =  Date.parse(element.check_in)
                found = Object.values(element).findIndex(date)
                if(found > 0){
                    sales.push([Date.parse(element.check_in), found])
                    console.log("matched"+found)
                }else{
                    sales.push([Date.parse(element.check_in), 1])
                }
                found = 0;
        })


      ));
  },
  methods: {

  }
}
</script>
