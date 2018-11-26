<template>
<div class="card">
  <div class="card-header">
    <router-link class="btn btn-sm btn-primary" :to="{ name: 'company-type'}" >
      <i class="fa fa-arrow-left"></i>
    </router-link>
    Editar Tipo de Empresa  
  </div>

  <div class="card-body">
    <form @submit="sendForm" novalidate>
      <div class="form-group">
        <label for="type">Tipo de Empresa</label>
        <input type="text" 
          name="type" 
          class="form-control type"
          v-model="item.type"
          :class="{ 'is-invalid': hashError('type') }"
          @keyup="validateType('type')"
          placeholder="Tipo de incidencia" 
          maxlength="25" 
          minlength="3" 
          required>
        <div class="invalid-feedback">
          {{errors.type}}
        </div>
      </div>
      <div class="row">
          <div class="col-md-6">
            <h4 class="mt-3 mb-2 p-2 text-white bg-primary">Documentos Requeridos</h4>
            <div class="table-responsive">
              <b-table striped hover show-empty stacked="sm"
                  :items="item.requeriments"
                  :small="true"
                  :fields="fields">
                <template slot="required" slot-scope="row">
                    <span v-if="row.item.required">SI</span>
                    <span v-else="row.item.required">No</span>
                </template>
                <template slot="actions" slot-scope="row">
                  <button type="button" class="btn btn-sm btn-primary"   @click="remove(row.item)">
                    <i class="fa fa-minus"></i>
                  </button>
                </template>
              </b-table>
            </div>
          </div>
          <div class="col-md-6">
            <h4 class="mt-3 mb-2 p-2 bg-warning text-white">Presione seleccionar para agregar un documento</h4>
            <div class="table-responsive">
              <b-table striped hover show-empty stacked="sm"
                  :items="requeriments"
                  :small="true"
                  :fields="fieldsAll">
                <template slot="required" slot-scope="row">
                    <span v-if="row.item.required">SI</span>
                    <span v-else="row.item.required">No</span>
                </template>
                <template slot="type" slot-scope="row">
                    <span  >{{row.item.requeriment_type.type}}</span>
                 </template>
                <template slot="actions" slot-scope="row">
                  <button type="button" class="btn btn-sm btn-primary"   @click="agregar(row.item)">
                    <i class="fa fa-plus"></i>
                  </button>
                </template>
              </b-table>
            </div>
          </div>
      </div>
      <button class="btn btn-primary" type="submit">Guardar</button>
    </form>
  </div>
</div>
</template>

<style type="text/css">
  .table-responsive{
    max-height: 400px;
  }
</style>

<script>

const Service = require('./../../service/company-type-service');
const ServiceRequeriment = require('./../../service/requeriment-service');

export default {
  name: 'company-type-edit',
  components: { },
  data () {
    return {
      item: { type: '', requeriments: []},
      errors: { type: [] },
      fields: [
        { key: 'actions', label: '',  'class': 'text-center' },
        { key: 'code', label: 'Codigo', sortable: true},
        { key: 'name', label: 'Requerimiento', sortable: true},
        { key: 'required', label: 'Obligatorio', sortable: true},
      ],
      fieldsAll: [
        { key: 'actions', label: '',  'class': 'text-center' },
        { key: 'code', label: 'Codigo', sortable: true},
        { key: 'name', label: 'Requerimiento', sortable: true},
        { key: 'required', label: 'Obligatorio', sortable: true},
        { key: 'type', label: 'Tipo', sortable: false},
      ],
      requeriments: []
    }
  },
  methods:{
    hashError: function(element){
      return this.errors[element].length !== 0;
    },
    validateType: function(element){
      this.errors[element] = [];
      if(this.item.type === ''){
        this.errors.type.push('Debe Ingresar un valor');
      }
      if(this.item.type.length < 3){
        this.errors.type.push('El valor de caracteres minimo son 3');
      }
      if(this.item.type.length > 25){
        this.errors.type.push('No Puede tener mas de 25 caracteres');
      }
    },
    agregar: function(item){
      let element= this.item.requeriments.find( e =>  e.id == item.id);
      if(element === undefined){
        this.item.requeriments.push(item)
      }
    },
    remove: function(item){
      let element= this.item.requeriments.findIndex( e =>  e.id == item.id);
      this.item.requeriments.splice(item,1);
    },
    sendForm: function(form) {
      form.preventDefault();
      form.stopPropagation();
      let _this = this
      if(form.target.checkValidity()){
        Service.save(this.item)
        .then(response => {
          _this.item = response.data.data;
          _this.$router.push({ name: 'company-type-detail', params: { id: _this.item.id }});
        })
        .catch(error=> _this.errors = error.response.data.errors);
      }
    }
  },
  mounted () {
    if(this.$route.params.id){
      Service.getById(this.$route.params.id).then(response => this.item = response.data.data);
    }
    ServiceRequeriment.index('','all').then(response => this.requeriments = response.data.data );
  }
}
</script>