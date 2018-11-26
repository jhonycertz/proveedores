<template>
  <div class="login">
       <div class="card-body card-block">
       <div class="alert alter-danget"> Credenciales Incorrectas</div>
        <form @submit="sendForm" novalidate>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
              <input type="email" v-model="email" id="email" name="email" placeholder="Email" class="form-control">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
              <input type="password" id="password" v-model="password" name="password" placeholder="Password" class="form-control">
            </div>
          </div>
          <div class="form-actions form-group">
              <button type="submit" class="btn btn-success btn-md">Log In</button>
          </div>
        </form>
      </div>
  </div>
</template>

<script>

const service = require('./service/auth-service');
const DashboardService = require('./service/dashboard-service');

export default {
  name: 'Login',
 data () {
    return {
      email: 'KraftHeinzVzlaProveedores@gmail.com',
      password: '1234'       
    }
  },
  methods:{
    sendForm: function(form) {
      form.preventDefault();
      form.stopPropagation();
      service.login({
        email: this.email,
        password: this.password
      })
      .then(response => {
        if(response.status === 200){
          this.$store.state.isLoggedIn =true;
          window.localStorage.setItem('token',JSON.stringify(response.data.success));
          DashboardService.getLogged().then(response => localStorage.setItem('charge', response.data));
          this.$router.push({name:'home'});
        }
      })
      .catch(error=> {
        console.error(error)
        this.errors ='Credenciales Incorrectas'
      });  
    }
  },
}
</script>

<style lang="scss" scoped>
  .card-title{
    padding-left: 20px;
  }
</style>