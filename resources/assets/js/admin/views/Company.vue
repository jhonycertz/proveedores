<template>
<div class="card">
  <div class="card-header">
    Empresas Nuevas
  </div>
  <div class="card-body">
    <div class="clearfix mt-2 mb-2">
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
        <template slot="actions" slot-scope="row">
          <router-link class="btn btn-sm btn-primary" :to="{ name: 'companies-news-detail', params: { id: row.item.id }}" >
            <i class="fa fa-info"></i>
          </router-link>
        </template>
        <template slot="companyType" slot-scope="row">
            <span  >{{row.item.company_type.type}}</span>
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

import AddComponent from '../components/AddComponent.vue'
const Service = require('./../service/company-service');

export default {
  name: 'company',
  components: { AddComponent },
  data () {
  return {
      items: items,
      fields: [
        { key: 'name', label: 'Empresa', sortable: false},
        { key: 'identity', label: 'rif', sortable: false},
        { key: 'companyType', label: 'Tipo'},
        { key: 'address', label: 'Direcciòn', sortable: false},
        { key: 'phone', label: 'Telefono', sortable: false},
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
        Service.delete(element.id).then(data => {
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
    Service.nuevas(this.search).then(response => this.items = response.data );
  }
}
</script>