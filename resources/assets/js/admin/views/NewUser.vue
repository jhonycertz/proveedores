<template>
<div class="card">
  <div class="card-header">
    <router-link class="btn btn-sm btn-primary" :to="{ name: 'users'}" >
      <i class="fa fa-arrow-left"></i>
    </router-link>
    <label v-if="isUpdating">Editar Usuario</label>
    <label v-else>Crear Usuario</label>
  </div>

  <div class="card-body">
    <form @submit="sendForm" novalidate>
      <div class="form-group">
        <label for="type">Nombre</label>
        <input type="text" 
          name="type" 
          class="form-control type"
          v-model="item.name"
          @keyup="validateForm()"
          placeholder="Ingrese el nombre" 
          maxlength="25" 
          minlength="3" 
          required>

        <div style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;" v-if="errorname == true">
          Por favor ingrese un nombre correcto
        </div>
      </div>
      <div class="form-group">
        <label for="type">Apellido</label>
        <input type="text" 
          name="type" 
          class="form-control type"
          v-model="item.surname"
          @keyup="validateForm()"
          placeholder="Ingrese el apellido" 
          maxlength="25" 
          minlength="3" 
          required>

        <div style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;" v-if="errorsurname == true">
            Por favor ingrese un apellido correcto
        </div>
      </div>
      <div class="form-group">
        <label for="type">Correo electronico</label>
        <input type="text" 
          name="type" 
          class="form-control type"
          v-model="item.email"
          @keyup="validateForm()"
          placeholder="Ingrese el correo" 
          maxlength="50" 
          minlength="3" 
          required>

        <div style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;" v-if="errormail == true">
            Por favor ingrese una dirección de correo valida
        </div>
      </div>
      <div class="form-group">
        <label for="type">Contraseña</label>
        <input type="password" 
          name="type" 
          class="form-control type"
          v-model="item.password"
          @keyup="validateForm()"
          placeholder="Ingrese su contraseña" 
          maxlength="25" 
          minlength="3" 
          required>

        <div style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;" v-if="errorpassword == true">
            Por favor ingrese una contraseña correcta
        </div>
      </div>
      <div class="form-group">
        <label for="type">Repetir Contraseña</label>
        <input type="password" 
          name="type" 
          class="form-control type"
          v-model="item.password2"
          @keyup="validateForm()"
          placeholder="Repita la Contraseña" 
          maxlength="25" 
          minlength="3" 
          required>
        <div style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;" v-if="errorpassword2 == true">
           Las contraseñas no coinciden
        </div>
      </div>
      <div class="form-group">
          <label>Rol:</label>
        <select v-model="item.role_id" class="form-control name" v-on:change="Change">
            <option disabled value="">Seleccione un Rol</option>
            <option :value="type.id" v-for="type in types" v-bind:key="type.id">{{type.role}}</option>
        </select>
        <div style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;" v-if="errorType == true">
          Debe seleccionar un Rol
        </div>
      </div>
      <button class="btn btn-primary" type="submit">Guardar</button>
    </form>
  </div>
</div>
</template>

<script>

const UsersService = require('./../service/users-service');
const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
export default {
  name: 'new-rol',
  components: { },
  data () {
    return {
      item: {
          name:'',
          surname: '',
          password: '',
          password2: '',
          role_id: ''
      },
      errors: { type: [] },
      types: {},
      errorType: false,
      isUpdating: false,
      errorpassword2: false,
      errorpassword: false,
      errorname: false,
      errorsurname: false,
      errorType: false,
      errormail: false
    }
  },
  methods:{
    Change: function(){
        this.errorType = false;
    },
    validateForm: function(){
        if (this.item.name === '' || this.item.name.length < 3 || this.item.name.length > 25) {
            this.errorname = true;            
        }else{
            this.errorname = false;         
        } 
        if(this.item.surname === '' || this.item.surname.length < 3 || this.item.surname.length > 25){
            this.errorsurname = true;
        }else{
            this.errorsurname = false;
        } 
        if(this.item.password === '' || this.item.password.length < 3 || this.item.password.length > 20){
            this.errorpassword = true;            
        }else{
            this.errorpassword = false;            
        }
        if(this.item.password2 != this.item.password){
            this.errorpassword2 = true;
        }else{
            this.errorpassword2 = false;
        } 
        if(this.item.role_id == ''){
            this.errorType = true;
        }else{
            this.errorType = false;
        }
        if (re.test(this.item.email)) {
            this.errormail = false;
        }else{
            this.errormail = true;
        }
    },
    sendForm: function(form) {
        form.preventDefault();
        form.stopPropagation();
        this.validateForm();
        var data = this.item;
        if (!this.errorname && !this.errorsurname && !this.errorpassword && !this.errorpassword2 && !this.errorpassword2 && !this.isUpdating) {
            UsersService.storeUser(data).then(response => window.history.back());
        }else if(!this.errorname && !this.errorsurname && !this.errorpassword && !this.errorpassword2 && !this.errorpassword2 && this.isUpdating){
            UsersService.updateUser(data).then(response => window.history.back());
        }

    },
    callOnMounted: function(){
        if(this.$route.params.id){
            this.isUpdating = true;
            var self = this;
            UsersService.getById(this.$route.params.id).then(function(response){
                self.item = response.data;     
                self.item.password = '';
            });
        }
      UsersService.getRoles().then(response => this.types = response.data);
    }
  },
  mounted () {
    this.callOnMounted();
  }
}
</script>