<template>
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">

            <highcharts :options="chartOptions" :constructor-type="'stockChart'"></highcharts>
            <highcharts :options="futurechartOptions" :constructor-type="'stockChart'"></highcharts>
            <highcharts :options="sales" :constructor-type="'stockChart'"></highcharts>

          </div>
        </div>
      </div>
</template>

<script>
import Highcharts from 'highcharts'
import stockInit from 'highcharts/modules/stock'
stockInit(Highcharts)
import {Chart} from 'highcharts-vue'
let sales = new Array()
let reservations = new Array()
let fsales   = [  [Date.parse("2020-2-01"), 2   ],
                [Date.parse("2020-2-04"), 3 ],
                [Date.parse("2020-2-08"), 1 ],
                [Date.parse("2020-2-09"), 4 ],
                [Date.parse("2020-2-24"), 5 ],
                [Date.parse("2020-2-29"), 7 ]]

export default {
  components: {
      highcharts: Chart
  },
  data(){
    return {
        reservations:[],
        sales:[],
        found:0,
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
                data: fsales
                }
                    ]
        },
        sales: {
             chart: {
                type: 'spline',
                animation: {
                    enabled: false
                }
            },
            title: {
                text: 'Reservations'
            },
            subtitle: {
                text: 'From reservation data recorded by the system.'
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
                name: 'Reservation',
                data: reservations
                }
                    ]
        }
    }
  },
  mounted () {
        let found;
        let date;
        let cash = 0;
        axios.get('api/reports').then(({data})=>(
        this.reservations = data,

            this.reservations.forEach((element, index) => {
                    this.reservations.forEach((x) => {
                        if(x.check_in == element.check_in){
                            found++
                            x.payments.forEach(pay => cash += pay.price)

                        }
                    })
                if(found > 0){
                    reservations.push([Date.parse(element.check_in), found])
                    sales.push([Date.parse(element.check_in), cash])
                    element[index] = null
                    console.log("matched"+found)
                }
                found = 0
                cash = 0
            })
        ));

  },
  methods: {

  }
}
</script>
