<template>
<div class="card">
  <div class="card-header">
    Requerimientos 
  </div>
  <div class="card-body">
    <div class="clearfix mt-2 mb-2">
        <add-component :url="'requeriment-new'" :title="'Agregar Nuevo Tipo de Requerimiento'" ></add-component>

        <div class="form-inline float-right">
            <div class="form-group">
              <input type="text" class="form-control-plaintext" placeholder="Buscar" v-model="search">
            </div>
            <button class="btn btn-primary btn-sm"  v-on:click="load">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>

    <div class="table-responsive">
      <b-table striped hover show-empty stacked="sm"
          :items="items.data"
          :small="true"
          :fields="fields">
        <template slot="required" slot-scope="row">
            <span v-if="row.item.required">SI</span>
            <span v-else="row.item.required">No</span>
        </template>
        <template slot="type" slot-scope="row">
            <span  >{{row.item.requeriment_type.type}}</span>
         </template>
        <template slot="actions" slot-scope="row">
          <router-link class="btn btn-sm btn-primary" :to="{ name: 'requeriment-detail', params: { id: row.item.id }}" >
            <i class="fa fa-info"></i>
          </router-link>
          <router-link class="btn btn-sm btn-primary" :to="{ name: 'requeriment-edit', params: { id: row.item.id }}"  >
            <i class="fa fa-edit"></i>
          </router-link>

          <button class="btn btn-sm btn-primary" v-if="charge == 0"  @click="eliminar(row.item)">
            <i class="fa fa-trash"></i>
          </button>

        </template>
      </b-table>
      <b-col md="6" class="my-1">
        <b-pagination 
            :total-rows="items.meta.total" 
            :per-page="items.meta.per_page" 
            v-model="items.meta.current_page" 
            @input="load"
            class="my-0" />
      </b-col>
    </div>
  </div>
</div>
</template>

<script>
const items = {
  data: [],
  meta:{
    total: 0,
    per_page: 1,
    current_page: 1 
  }
};

//const loadItems = (search,page = 1) => axios.get('http://localhost:8000/api/requeriment',{ params:{ page: page, search: search }});

import AddComponent from '../components/AddComponent.vue'
const Service = require('./../service/requeriment-service');

export default {
  name: 'requeriment',
  components: { AddComponent },
  data () {
  return {
      items: items,
      fields: [
        { key: 'code', label: 'Codigo', sortable: false},
        { key: 'name', label: 'Requerimiento', sortable: false},
        { key: 'required', label: 'Obligatorio', sortable: false},
        { key: 'type', label: 'Tipo', sortable: false},
        { key: 'actions', label: '',  'class': 'text-center' }
      ],
      search: ''
    }
  },
  methods:{
    load: function(page) {
      Service.index(this.search,page).then(response => this.items = response.data );
    },
    eliminar: function(element){
      this.$dialog.confirm('Eliminar',{ okText: "Eliminar",  loader: true,  verification: 'continue'})
      .then(dialog => {
        Service.delete(element.id).then(
          data => {
            Service.index(this.search,this.items.current_page).then(response => this.items = response.data );
            dialog.close();
          })
          .catch( c => {
            console.error(c);
            dialog.close();
          });
      });
    }
  },
  mounted () {
    Service.index(this.search).then(response => this.items = response.data );
    this.charge = localStorage.getItem('charge');
  }
}
</script>