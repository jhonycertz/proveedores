<script src="https://www.gstatic.com/charts/loader.js"></script>
<template>
    <div class="card">
        <div class="card-header">
            <h3>Gráficas</h3>
        </div>
        <div class="card-body" style="padding: 2.25em">
            <div class="row">
                <div class="col-md-6">
                    <pie-chart :donut="true" :data="donutData" :colors="chartColors"></pie-chart>
                </div>
                <div class="col-md-6">
                    <pie-chart :data="donutData" :colors="chartColors"></pie-chart>
                </div>
                <div class="col-md-6">
                    <column-chart :data="columnData" :colors="chartColors"></column-chart>
                </div>
                <div class="col-md-6">
                    <line-chart :data="lineData" :colors="chartColors"></line-chart>
                </div>
                <div class="col-md-12">
                <line-chart :data="data" :colors="chartColors"/>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
const ChartsService = require('./../service/charts-service');
import VueChartkick from 'vue-chartkick'
import Chart from 'chart.js'
export default{
    name: 'dashboard',
    components: {
    },
    data(){
        return{
            
            data: [
                {name: 'Workout', data: {'2017-01-01 00:00:00 -0800': 3, '2017-01-02 00:00:00 -0800': 4}},
                {name: 'Call parents', data: {'2017-01-01 00:00:00 -0800': 5, '2017-01-02 00:00:00 -0800': 3}}
            ],
            donutData: [['Mantenimiento Tipo A', 44], ['Mantenimiento Tipo B', 23], ['Limpieza', 31], ['Vigilancia', 12]],
            columnData: [['Lun', 11], ['Mar', 16], ['Mie', 32], ['Jue', 46], ['Vie', 28], ['Sab', 4], ['Dom', 65] ],
            chartColors: ['#3D5AFE', '#1E88E5','#00B0FF' ,'#0097A7' ,'#00695C' ,'#BF360C' ,'#607D8B' ,'#880E4F' ],
            lineData: {'2017-05-13': 2, '2017-05-14': 5, '2017-05-15': 8, '2017-05-16': 6, '2017-05-17': 11, '2017-05-18': 4}
        }
    },
    mounted(){
        this.callMounted();
    },
    methods:{
        callMounted: function(){
            console.log('holis');
            
        }
    }
}
</script>