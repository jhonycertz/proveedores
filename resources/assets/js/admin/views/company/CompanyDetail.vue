<template>
<div class="card">
  <div class="card-header">
    <router-link class="btn btn-sm btn-primary" :to="{ name: 'companies-news'}" v-if="item.status==='ESPERA'">
      <i class="fa fa-arrow-left"></i>
    </router-link>

    <router-link class="btn btn-sm btn-primary" :to="{ name: 'companies-en-proceso'}" v-if="item.status==='EN-PROCESO'">
      <i class="fa fa-arrow-left"></i>
    </router-link>

    <router-link class="btn btn-sm btn-primary" :to="{ name: 'companies-rehazada'}" v-if="item.status==='RECHAZADA'">
      <i class="fa fa-arrow-left"></i>
    </router-link>

    <router-link class="btn btn-sm btn-primary" :to="{ name: 'companies-aprobadas'}" v-if="item.status==='APROBADA'">
      <i class="fa fa-arrow-left"></i>
    </router-link>

    Empresa  
  </div>

  <div class="card-body">
    <div class="row">
      <div class="col-md-6" v-if="item">
        <p class="font-weight-bold">Nombre : {{ item.name }}</p>
        <p class="font-weight-bold">Identidad : {{ item.identity }}</p>
        <p class="font-weight-bold">Direcciòn : {{ item.address }}</p>
        <p class="font-weight-bold">Telefono : {{ item.phone }}</p>
        <p class="font-weight-bold">Correo : {{ item.email }}</p>
        <p class="font-weight-bold" v-if="item.company_type">Tipo : {{ item.company_type.type }}</p>
        <p class="font-weight-bold">Estado : {{ item.status }}</p>
        <p v-if="item.status == 'ESPERA'">
          <button class="btn btn-danger" v-on:click="rechazar" type="button">Reprobar</button>
          <button class="btn btn-primary" v-on:click="aprobar" type="button">Aprobar</button>
        </p>
        <p>
          <small> al aprobar se iniciara el proceso de seleccion </small>
        </p>
      </div>
      <div class="col-md-6">
        <embed  v-bind:src="item.catalogo_path" width="100%" height="500px" type='application/pdf'>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import AddComponent from '../../components/AddComponent.vue'
const service = require('./../../service/company-service');

const item = {
  data: { 
    type: '',
    requeriments: []
  } 
};

export default{
  name: 'comprany-type-detail',
  components: { AddComponent },
  data () {
    return {
      item: item,
      fields: [


      ],
    }
  },
  methods:{
    aprobar: function(element){
      if (confirm('Esta seguro de aprobar esta empresa ')) {
        service.procesar(this.item).then(r => {
          this.item = r.data.data;
        });
      }
      window.history.back();
    },
    rechazar: function(element){
      if (confirm('Esta seguro de reprobar esta empresa ')) {
        service.reprobar(this.item).then(r => {
          this.item = r.data.data;
        });
      }
    },
  },
  mounted () {
    service.getById(this.$route.params.id)
    .then(response => {
      this.item = response.data.data
    });
  }

}
</script>