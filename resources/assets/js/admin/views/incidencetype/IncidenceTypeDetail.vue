<template>
<div class="card">
  <div class="card-header">
    <router-link class="btn btn-sm btn-primary" :to="{ name: 'incidenceType'}">
      <i class="fa fa-arrow-left"></i>
    </router-link>
    Tipo de Incidencia  
  </div>

  <div class="card-body">
    <p class="font-weight-bold">Tipo Incidencia : {{ item.type }}</p>
  </div>
</div>
</template>

<script>
import AddComponent from '../../components/AddComponent.vue'
const IncidenceService = require('./../../service/incidence-type-service');

const item = {
  data: { 
    type: {}
  }
};

export default{
  name: 'incidence-type-detail',
  components: { AddComponent },
  data () {
    return {
      item: item,
    }
  },
  mounted () {
    IncidenceService.getById(this.$route.params.id)
    .then(response => {
      console.log(response.data.data)
      this.item = response.data.data
    });
  }

}
</script>