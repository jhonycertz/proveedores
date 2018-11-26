<template>
<div class="card">
  <div class="card-header">
    <router-link class="btn btn-sm btn-primary" :to="{ name: 'requeriment'}">
      <i class="fa fa-arrow-left"></i>
    </router-link>
    Requerimientos
  </div>

  <div class="card-body">
    <p class="font-weight-bold">Codigo : {{ item.code }}</p>
    <p class="font-weight-bold">Requerimiento : {{ item.name }}</p>
    <p class="font-weight-bold">Obligatorio : {{ item.required }}</p>
    <p class="font-weight-bold">Tipo : {{ item.requeriment_type.type }}</p>
  </div>
</div>
</template>

<script>
import AddComponent from '../../components/AddComponent.vue'
const service = require('./../../service/requeriment-service');

const item = {
  requeriment_type: { type: '' },
  code: '',
  required: '',
  name: ''
};

export default{
  name: 'requeriment-detail',
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