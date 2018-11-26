<template>
<div class="card">
  <div class="card-header">
    <router-link class="btn btn-sm btn-primary" :to="{ name: 'requeriment'}" >
      <i class="fa fa-arrow-left"></i>
    </router-link>
    Editar Requerimiento  
  </div>

  <div class="card-body">
    <form @submit="sendForm" novalidate>
      <div class="form-group">
        <label for="code">Codigo</label>
        <input type="text" 
          name="code" 
          class="form-control code"
          v-model="item.code"
          :class="{ 'is-invalid': hashError('code') }"
          @keyup="validateType('code')"
          placeholder="Codigo">
        <div class="invalid-feedback">
          {{errors.code}}
        </div>
      </div>
      <div class="form-group">
        <label for="name">Requerimiento</label>
        <input type="text" 
          name="name" 
          class="form-control name"
          v-model="item.name"
          :class="{ 'is-invalid': hashError('name') }"
          @keyup="validateType('name')"
          placeholder="Requerimiento" >
        <div class="invalid-feedback">
          {{errors.name}}
        </div>
      </div>
      <div class="form-group">
        <label for="name">Tipo </label>
        <select 
          name="requeriment_type"
          class="form-control name"
          v-model="item.requeriment_type.id"
          :class="{ 'is-invalid': hashError('requeriment_type') }"
          @keyup="validateType('requeriment_type')">
          <option v-for="option in types" v-bind:value="option.id">
            {{ option.type }}
          </option>
        </select>
        <div class="invalid-feedback">
          {{errors.requeriment_type}}
        </div>
      </div>


      <div class="form-group">
        <label for="required">Obligatorio </label>
        <select 
          name="requeriment_type"
          class="form-control required"
          v-model="item.required"
          :class="{ 'is-invalid': hashError('requeriment_type') }"
          @keyup="validateType('required')">
          <option v-for="option in obligatorios" v-bind:value="option.id ">
            {{ option. name }}
          </option>
        </select>
        <div class="invalid-feedback">
          {{errors.required}}
        </div>
      </div>
      <button class="btn btn-primary" type="submit">Guardar</button>
    </form>
  </div>
</div>
</template>

<script>

const Service = require('./../../service/requeriment-service');
const ServiceType = require('./../../service/requeriment-type-service');
 

export default {
  name: 'requeriment-edit',
  components: { },
  data () {
    return {
      item: {
        requeriment_type: { id: '', type: '' },
        code: '',
        required: '',
        name: ''
      },
      obligatorios: [{id: true, name: "SI"},{id: false, name: "NO", }],
      errors: { name: [], code: [],required :[], requeriment_type: [] },
      types: []
    }
  },
  methods:{
    hashError: function(element){
      return this.errors[element].length !== 0;
    },
    validateType: function(element){

    },
    sendForm: function(form) {
      form.preventDefault();
      form.stopPropagation();
      let _this = this
      if(form.target.checkValidity()){
        Service.save(this.item)
        .then(response => {
          _this.item = response.data.data;
          _this.$router.push({ name: 'requeriment-detail', params: { id: _this.item.id }});
        })
        .catch(error=> _this.errors = error.response.data.errors);
      }
    }
  },
  mounted () {
    if(this.$route.params.id){
      Service.getById(this.$route.params.id).then(response => this.item = response.data.data);
     }
    ServiceType.index(null,'all').then(response => this.types = response.data.data );
  }
}
</script>