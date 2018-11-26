<template>
<div class="card">
  <div class="card-header">
    <router-link class="btn btn-sm btn-primary" :to="{ name: 'requeriment-type'}" >
      <i class="fa fa-arrow-left"></i>
    </router-link>
    Editar Tipo de Requerimiento  
  </div>

  <div class="card-body">
    <form @submit="sendForm" novalidate>
      <div class="form-group">
        <label for="type">Tipo de Requerimiento</label>
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
      <button class="btn btn-primary" type="submit">Guardar</button>
    </form>
  </div>
</div>
</template>

<script>

const Service = require('./../../service/requeriment-type-service');

export default {
  name: 'requeriment-type-edit',
  components: { },
  data () {
    return {
      item: { type: ''},
      errors: { type: [] }
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
    sendForm: function(form) {
      form.preventDefault();
      form.stopPropagation();
      let _this = this
      if(form.target.checkValidity()){
        Service.save(this.item)
        .then(response => {
          _this.item = response.data;
          _this.$router.push({ name: 'requeriment-type-detail', params: { id: _this.item.id }});
        })
        .catch(error=> _this.errors = error.response.data.errors);
      }
    }
  },
  mounted () {
    if(this.$route.params.id){
      Service.getById(this.$route.params.id).then(response => this.item = response.data.data);
    }
  }
}
</script>