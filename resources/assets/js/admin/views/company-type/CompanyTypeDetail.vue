<template>
<div class="card">
  <div class="card-header">
    <router-link class="btn btn-sm btn-primary" :to="{ name: 'company-type'}">
      <i class="fa fa-arrow-left"></i>
    </router-link>
    Tipo de Empresa  
  </div>

  <div class="card-body">
    <p class="font-weight-bold">Tipo Empresa : {{ item.type }}</p>
    <h4 class="mt-4 mb-2 p-2 text-white bg-primary">Documentos Requeridos</h4>
    <div class="table-responsive">
      <b-table striped hover show-empty stacked="sm"
          :items="item.requeriments"
          :small="true"
          :fields="fields">
        <template slot="required" slot-scope="row">
            <span v-if="row.item.required">SI</span>
            <span v-else="row.item.required">No</span>
        </template>
      </b-table>
    </div>
  </div>
</div>
</template>

<script>
import AddComponent from '../../components/AddComponent.vue'
const service = require('./../../service/company-type-service');

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
        { key: 'code', label: 'Codigo', sortable: true},
        { key: 'name', label: 'Requerimiento', sortable: true},
        { key: 'required', label: 'Obligatorio', sortable: true},
      ],
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