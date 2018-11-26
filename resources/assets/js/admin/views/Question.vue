<template>
<div class="card">
  <div class="card-header">
    Preguntas
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
        <template slot="company" slot-scope="row">
          {{row.item.client.company.identity}} -- {{row.item.client.company.name}}
        </template>
        <template slot="actions" slot-scope="row">

          <router-link class="btn btn-sm btn-primary" :to="{ name: 'question-edit', params: { id: row.item.id }}"  >
            <i class="fa fa-edit"></i>
          </router-link>

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
const Service = require('./../service/question-service');

export default {
  name: 'requeriment-type',
  components: { AddComponent },
  data () {
  return {
      items: items,
      fields: [
        { key: 'question', label: 'Pregunta', sortable: false},
        { key: 'company', label: 'Empresa', sortable: false},
        { key: 'status', label: 'Estado', sortable: false},
        { key: 'actions', label: '',  'class': 'text-center' }
      ],
      search: ''
    }
  },
  methods:{
    load: function(page) {
      Service.index(this.search,page).then(response => this.items = response.data );
    }
  },
  mounted () {
    Service.index(this.search).then(response => this.items = response.data );
  }
}
</script>