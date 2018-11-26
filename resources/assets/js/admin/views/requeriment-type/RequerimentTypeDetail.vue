<template>
<div class="card">
  <div class="card-header">
    <router-link class="btn btn-sm btn-primary" :to="{ name: 'requeriment-type'}">
      <i class="fa fa-arrow-left"></i>
    </router-link>
    Tipo de Requerimiento  
  </div>

  <div class="card-body">
    <p class="font-weight-bold">Tipo Requerimiento : {{ item.type }}</p>
  </div>
</div>
</template>

<script>
import AddComponent from '../../components/AddComponent.vue'
const service = require('./../../service/requeriment-type-service');

const item = {
  data: { 
    type: {}
  }
};

export default{
  name: 'requeriment-type-detail',
  components: { AddComponent },
  data () {
    return {
      item: item,
    }
  },
  mounted () {
    service.getById(this.$route.params.id)
    .then(response => {
      this.item = response.data.data
    });
  }

}
</script>