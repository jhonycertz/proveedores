<template>
    <div class="card">
        <div class="card-header">
            <h3>Nuevas incidencias</h3>
        </div>
        <div class="card-body" style="padding: 2.25em">
            <div class="row">
                <div class="col-md-5">
                    <h4>Nuevos mensajes</h4>
                    <br>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Empresa</th>
                                <th scope="col">Pregunta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="message in messages" v-bind:key="message.id" >
                                <td>{{message.client.company.name}}</td>
                                <td>{{message.question}}</td>
                            </tr>
                        </tbody>
				    </table>
                </div>
                <div class="col-md-7">
                    <h4>Nuevos documentos</h4>
                    <br>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Empresa</th>
                                <th scope="col">Requerimiento</th>
                                <th scope="col">Archivo</th>
                                <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr  v-for="item in items" v-bind:key="item.id">
                                <td>{{item.client.company.name}}</td>
                                <td>{{item.requeriment.name}}</td>
                                <td><a :href="'/'+item.file_path" target="_blank">{{item.name}}</a></td>
                                <td><a :href="'admin#/companies/news/show/'+item.client.company.id+'/documents'" class="btn btn-sm btn-primary">Ver empresa</a></td>
                            </tr>
                        </tbody>
				    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
const DashboardService = require('./../service/dashboard-service');
export default{
    name: 'dashboard',
    components: {
    },
    data(){
        return{
            
            items: {},
            user: {},
            messages: {}
        }
    },
    mounted(){
        this.callMounted();
    },
    methods:{
        callMounted: function(){
            DashboardService.index().then(response => this.items = response.data );
            DashboardService.getLogged().then(response => localStorage.setItem('charge', response.data));
            DashboardService.getMessages().then(response => this.messages = response.data); 
        }
    }
}
</script>