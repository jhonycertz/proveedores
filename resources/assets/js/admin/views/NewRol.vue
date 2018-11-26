<template>
<div class="card">
  <div class="card-header">
    <router-link class="btn btn-sm btn-primary" :to="{ name: 'roles'}" >
      <i class="fa fa-arrow-left"></i>
    </router-link>
    Editar Rol
  </div>

  <div class="card-body">
    <form @submit="sendForm" novalidate>
      <div class="form-group">
        <label for="type">Nombre del Rol</label>
        <input type="text" 
          name="type" 
          class="form-control type"
          v-model="item.role"
          :class="{ 'is-invalid': hashError('type') }"
          @keyup="validateType('type')"
          placeholder="Rol" 
          maxlength="25" 
          minlength="3" 
          required>

        <div class="invalid-feedback">
          {{errors.type}}
        </div>
      </div>
      <div class="form-group">
          <label>Departamento a cargo de:</label>
        <select v-model="item.charge.id" class="form-control name" v-on:change="Change">
            <option :value="0" selected>Todos los permisos</option>
            <option :value="type.id" v-for="type in types" v-bind:key="type.id">{{type.type}}</option>
        </select>
        <div style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;" v-if="errorType == true">
          debe seleccionar un departamento
        </div>
      </div>
      <button class="btn btn-primary" type="submit">Guardar</button>
    </form>
  </div>
</div>
</template>

<script>

const RoleService = require('./../service/role-service');

export default {
  name: 'new-rol',
  components: { },
  data () {
    return {
      item: { 
                role: '',
                charge:{
                    id: 1000
                }
            },
      errors: { type: [] },
      types: {},
      errorType: false,
      isUpdating: false
    }
  },
  methods:{
    Change: function(){
          this.errorType = false;
    },
    hashError: function(element){
      return this.errors[element].length !== 0;
    },
    validateType: function(element){
      this.errors[element] = [];
      if(this.item.role === ''){
        this.errors.type.push('Debe Ingresar un valor');
      }
      if(this.item.role.length < 3){
        this.errors.type.push('El valor de caracteres minimo son 3');
      }
      if(this.item.role.length > 25){
        this.errors.type.push('No Puede tener mas de 25 caracteres');
      }
    },
    sendForm: function(form) {
        form.preventDefault();
        form.stopPropagation();
        this.validateType('type');
        if (this.item.charge.id == 1000) {
            this.errorType = true;
        } else if (this.isUpdating){
            var data = {role: this.item.role, charge: this.item.charge.id, id: this.item.id};
            RoleService.updateRole(data).then(function(response){
                window.history.back();
            });
        } else {
            var data = {role: this.item.role, charge: this.item.charge.id};
                RoleService.storeRole(data).then(response => this.item = response.data);
                window.history.back();
                this.callOnMounted();          
        }
        },
        callOnMounted: function(){
            if(this.$route.params.id){
                RoleService.getById(this.$route.params.id).then(response => this.item = response.data);
                this.isUpdating = true;
            }
            RoleService.getChargesTypes().then(response => this.types = response.data);
        }
    },
    mounted () {
        this.callOnMounted();
    }
}
</script>