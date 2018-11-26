<template>
<div class="card">
  <div class="card-header">
    Administración de roles 
  </div>
  <div class="card-body">
    <div class="clearfix mt-2 mb-2">
        <add-component :url="'new-rol'" :title="'Agregar Nuevo Rol'" ></add-component>
    </div>

    <div class="table-responsive">
      <b-table striped hover show-empty stacked="sm"
          :items="items"
          :small="true"
          :fields="fields">
        <template slot="actions" slot-scope="row">
          <router-link class="btn btn-sm btn-primary" :to="{ name: 'role-edit', params: { id: row.item.id }}"  >
            <i class="fa fa-edit"></i>
          </router-link>
          <button class="btn btn-sm btn-primary" v-if="charge == 0"  @click="eliminar(row.item.id)">
            <i class="fa fa-trash"></i>
          </button>

        </template>
      </b-table>
      <!--<b-col md="6" class="my-1">
        <b-pagination 
            :total-rows="items.meta.total" 
            :per-page="items.meta.per_page" 
            v-model="items.meta.current_page" 
            @input="load"
            class="my-0" />
      </b-col>-->
    </div>
  </div>
</div>
</template>

<script>


//const loadItems = (search,page = 1) => axios.get('http://localhost:8000/api/incidence-type',{ params:{ page: page, search: search }});

import AddComponent from '../components/AddComponent.vue'
const RoleService = require('./../service/role-service');

export default {
  name: 'incidence-type',
  components: { AddComponent },
  data () {
  return {
      items: [],
      fields: [
        { key: 'role', label: 'Rol', sortable: false},
        { key: 'charge.type', label: 'Cargo', sortable: false },
        { key: 'actions', label: '',  'class': 'text-center' }
      ],
    }
  },
  methods:{
    load: function(page) {
      RoleService.index().then(response => this.items = response.data );
    },
    callOnMounted: function(){
      RoleService.index().then(response => this.items = response.data );
    },
    eliminar: function(id){
      this.$dialog.confirm('Eliminar',{ okText: "Eliminar",  loader: true,  verification: 'continue'})
      .then(dialog => {
        RoleService.deleteRole(id).then(
          response => this.callOnMounted()
          )        
        dialog.close();
      });
    }
  },
  beforeMount() {
    },
  mounted () {
    this.callOnMounted();
    this.charge = localStorage.getItem('charge');
  }
}
</script>