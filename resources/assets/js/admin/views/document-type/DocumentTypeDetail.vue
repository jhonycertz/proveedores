<template>
<div class="card">
  <div class="card-header">
    <router-link class="btn btn-sm btn-primary" :to="{ name: 'document-type'}">
      <i class="fa fa-arrow-left"></i>
    </router-link>
    Tipo de Documento  
  </div>

  <div class="card-body">
    <p class="font-weight-bold">Tipo Documento : {{ item.type }}</p>
  </div>
</div>
</template>

<script>
import AddComponent from '../../components/AddComponent.vue'
const service = require('./../../service/document-type-service');

const item = {
  data: { 
    type: {}
  }
};

export default{
  name: 'document-type-detail',
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