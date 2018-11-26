<template>
<div class="card">
  <div class="card-header">
    Administración de roles 
  </div>
  <div class="card-body">
    <div class="clearfix mt-2 mb-2">
        <add-component :url="'new-user'" :title="'Agregar Nuevo Administrador'" ></add-component>
    </div>

    <div class="table-responsive">
      <b-table striped hover show-empty stacked="sm"
          :items="items"
          :small="true"
          :fields="fields">
        <template slot="actions" slot-scope="row">
          <router-link class="btn btn-sm btn-primary" :to="{ name: 'edit-user', params: { id: row.item.id }}"  >
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
const UsersService = require('./../service/users-service');

export default {
  name: 'incidence-type',
  components: { AddComponent },
  data () {
  return {
      items: [],
      fields: [
        { key: 'name', label: 'Nombre', sortable: false},
        { key: 'surname', label: 'Apellido', sortable: false },
        { key: 'email', label: 'Correo', sortable: false },
        { key: 'role.role', label: 'Rol', sortable: false },
        { key: 'actions', label: '',  'class': 'text-center' }
      ],
    }
  },
  methods:{
    callOnMounted: function(){
      UsersService.index().then(response => this.items = response.data );
    },
    eliminar: function(id){
      this.$dialog.confirm('Eliminar',{ okText: "Eliminar",  loader: true,  verification: 'continue'})
      .then(dialog => {
        UsersService.deleteUser(id).then(
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