<template>
  <div  class="card-body">
    <div :class="{ 'd-none': !status }">
        <h4>Registro Exitoso, nos estaremos comunicando </h4>
    </div>    
    <form enctype="multipart/form-data" @submit="sendForm" :class="{ 'd-none': status }">
      <div class="owl-carousel owl-theme">
        <div class="item">
          <h4>Datos de la Empresa </h4>
          <div class="form-row">
            <div class="form-group col-md-6">
                <label for="identity">Identidad </label>
                <input id="identity" 
                  type="text" 
                  v-model="company.identity" 
                  class="form-control" 
                  placeholder="rif" 
                  maxlength="50" 
                  :class="{ 'is-invalid': hashErrorCompany('identity') }"
                  @keyup="clearCompany('identity')"
                  required>
                <div class="invalid-feedback">
                  {{errors.company.identity}}
                </div>
              </div>
              <div class="form-group col-md-6">
                <label for="name">Nombre </label>
                <input type="text" 
                  v-model="company.name" 
                  class="form-control" 
                  placeholder="Nombre de la organización"  
                  :class="{ 'is-invalid': hashErrorCompany('name') }"
                  @keyup="clearCompany('name')"
                  maxlength="50">
                <div class="invalid-feedback">
                  {{errors.company.name}}
                </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="email">Correo Electronico </label>
              <input type="text" 
                v-model="company.email" 
                class="form-control" 
                placeholder="@gmail.com" 
                :class="{ 'is-invalid': hashErrorCompany('email') }"
                @keyup="clearCompany('email')"
                maxlength="50">
              <div class="invalid-feedback">
                {{errors.company.email}}
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="phone">Telefono </label>
              <input type="text" 
                v-model="company.phone" 
                class="form-control" 
                placeholder="####-#######"  
                :class="{ 'is-invalid': hashErrorCompany('phone') }"
                @keyup="clearCompany('phone')"
                maxlength="15">
              <div class="invalid-feedback">
                {{errors.company.phone}}
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="address">Dirección </label>
            <textarea 
              name="address" 
              class="form-control" 
              id="address"  
              v-model="company.address"  
              :class="{ 'is-invalid': hashErrorCompany('address') }"
              @keyup="clearCompany('address')"
              maxlength="300">
              </textarea>
            <div class="invalid-feedback">
              {{errors.company.address}}
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="company_type_id">Clasificación </label>
              <select id="company_type_id" 
                v-model="company.company_type" 
                class="form-control" 
                :class="{ 'is-invalid': hashErrorCompany('company_type_id') }"
                @keyup="clearCompany('company_type_id')"
                required>
                <option v-for="option in types" v-bind:value="option">
                  {{ option.type }}
                </option>
              </select>
              <div class="invalid-feedback">
                {{errors.company.company_type_id}}
              </div>
            </div>

            <div class="form-group col-md-6">
              <label for="catalogo_path">Catalogo de servicios </label>
              <div class="form-control" 
                :class="{ 'is-invalid': hashErrorCompany('catalogo_path') }" 
                >
                <input type="file" accept="application/pdf" v-on:change="handleFileUpload" @keyup="clearCompany('catalogo_path')" required>
              </div>
              <div class="invalid-feedback">
                {{errors.company.catalogo_path}}
              </div>
            </div>
          </div>
          <p>
            <a href="#" class="btn btn-primary btn-sm" @click="next"><span class="fa fa-arrow-right"></span> </a>
          </p>
        </div>

        <div class="item">
          <h4>Datos del contacto </h4>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="name">Nombre </label>
              <input type="text" 
                v-model="contact.name"
                :class="{ 'is-invalid': hashErrorContact('name') }"
                @keyup="clearContact('name')"
                class="form-control" 
                placeholder="Nombre del contact">
                <div class="invalid-feedback">
                  {{errors.contact.name}}
                </div>
            </div> 

            <div class="form-group col-md-6">
              <label for="email">Correo </label>
              <input type="text"  
                v-model="contact.email" 
                :class="{ 'is-invalid': hashErrorContact('email') }"
                @keyup="clearContact('email')"
                class="form-control" 
                placeholder="Correo">
                <div class="invalid-feedback">
                  {{errors.contact.email}}
                </div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="name">Telefono </label>
              <input type="text"  
                v-model="contact.phone" 
                :class="{ 'is-invalid': hashErrorContact('phone') }"
                @keyup="clearContact('phone')"
                class="form-control " 
                placeholder="numero donde podamos contactarlo">
                <div class="invalid-feedback">
                  {{errors.contact.phone}}
                </div>
            </div>
            <div class="form-group col-md-6">
              <label for="cargo">Cargo </label>
              <input type="text" 
                name="cargo" 
                v-model="contact.cargo" 
                :class="{ 'is-invalid': hashErrorContact('cargo') }"
                @keyup="clearContact('cargo')"
                class="form-control" 
                placeholder="cargo que ocupa en la organizacion">
                <div class="invalid-feedback">
                </div>
            </div>
          </div>
          <p>
            <a href="#" class="btn btn-primary btn-sm" @click="prev"><span class="fa fa-arrow-left"></span> </a>
            <a href="#" class="btn btn-primary btn-sm" @click="next"><span class="fa fa-arrow-right"></span> </a>
          </p>
        </div>
        
        <div class="item">
          <h4> 
            Clientes
          </h4>
          <div class="table-responsive" style="width: 450px">
            <a href="#" class="btn btn-primary btn-sm float-right" @click="customers.push({name: '', phone: ''})">
              <span class="fa fa-plus"></span>
            </a> 
            <table class="table">
              <thead>
                <tr>
                  <th>
                                     
                  </th>
                  <th>Empresa</th>
                  <th scope="col">Contacto</th>
                </tr>
              </thead>
              <tbody v-for="item in customers">
                <tr>
                  <th>
                    <a href="#" class="btn btn-primary btn-sm float-right" @click="remove(item)">
                      <span class="fa fa-minus"></span>
                    </a>
                  </th>
                  <td>
                    <input type="text" v-model="item.name" class="form-control">
                  </td>
                  <td>
                    <input type="text" v-model="item.phone" class="form-control">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <p>
            <a href="#" class="btn btn-primary btn-sm" @click="prev"><span class="fa fa-arrow-left"></span> </a>
            <button type="submit" @click="sendForm" class="btn btn-primary float-right">Registrar</button>
          </p>
        </div>
      </div> 
    </form>

  </div>
</template>

<script>
export default {
  data () { 
    return {
      status: false,
      types: [],
      carousel: null,
      errors: {
        company : {
          identity: '',
          name: '',
          email: '',
          phone: '',
          address: '',
          company_type_id: '',
          catalogo_path: ''
        },
        contact: {
          name: '',
          email: '',
          phone: '',
          cargo: '',
        },
      },
      company : {
        identity: '',
        name: '',
        email: '',
        phone: '',
        address: '',
        company_type_id: '',
        catalogo_path: ''
      },
      contact: {
        name: '',
        email: '',
        phone: '',
        cargo: '',
      },
      customers: [{name: '', phone: ''}]
    }
  },
  components: {

  },
  methods:{
    prev: function(){ this.carousel.trigger('prev.owl.carousel')},
    next: function(){ this.carousel.trigger('next.owl.carousel')},
    remove: function(item){
      this.customers.splice(_.indexOf(this.customers,item),1)
    },
    sendForm: function(form){
      form.preventDefault();
      form.stopPropagation();
      let errorComapny = false;
      let errorContact = false; 

      if(this.empty(this.company.identity)){
        this.errors.company.identity = 'Campo requerido';
        errorComapny = true;
      }
      if(this.empty(this.company.name)){
        this.errors.company.name = 'Campo requerido';
        errorComapny = true;
      }
      if(this.empty(this.company.email)){
        this.errors.company.email = 'Campo requerido';
        errorComapny = true;
      }
      if(this.empty(this.company.phone)){
        this.errors.company.phone = 'Campo requerido';
        errorComapny = true;
      }
      if(this.empty(this.company.address)){
        this.errors.company.address = 'Campo requerido';
        errorComapny = true;
      }
      if(this.empty(this.company.catalogo_path)){
        this.errors.company.catalogo_path = 'Campo requerido';
        errorComapny = true;
      }


      if(this.empty(this.contact.name)){
        this.errors.contact.name = 'Campo requerido';
        errorContact = true;
      }
      if(this.empty(this.contact.email)){
        this.errors.contact.email = 'Campo requerido';
        errorContact = true;
      }
      if(this.empty(this.contact.phone)){
        this.errors.contact.phone = 'Campo requerido';
        errorContact = true;
      }
      if(this.empty(this.contact.cargo)){
        this.errors.contact.cargo = 'Campo requerido';
        errorContact = true;
      }

      if(errorComapny){
        this.carousel.trigger('prev.owl.carousel');
        this.carousel.trigger('prev.owl.carousel');
      }
      else if(errorContact){
        this.carousel.trigger('prev.owl.carousel');
      }

  
      if(!errorContact && !errorComapny ){
        this.company.company_type_id = this.company.company_type.id;
        let formData = new FormData();
        formData.append("company[identity]",this.company.identity);
        formData.append("company[name]",this.company.name);
        formData.append("company[email]",this.company.email);
        formData.append("company[phone]",this.company.phone);
        formData.append("company[address]",this.company.address);
        formData.append("company[company_type_id]",this.company.company_type_id);
        formData.append("company[catalogo_path]",this.company.catalogo_path);

        formData.append("contact[name]",this.contact.name);
        formData.append("contact[email]",this.contact.email);
        formData.append("contact[phone]",this.contact.phone);
        formData.append("contact[role]",this.contact.cargo);

        for( var i = 0; i < this.customers.length; i++ ){
          let customer = this.customers[i];
          formData.append('customers['+i+'][name]',customer.name);
          formData.append('customers['+i+'][phone]',customer.phone);
        }
        let _this = this;
        axios.post('',formData).then(function(){
          _this.status = true;
        });
      }
    },
    empty(data) {
      return data.toString().length === 0;
    },
    hashErrorCompany: function(element){
      return this.errors.company[element].length !== 0;
    },
    clearCompany: function(element){
      return this.errors.company[element] = "";
    },
    hashErrorContact: function(element){
      return this.errors.contact[element].length !== 0;
    },
    clearContact: function(element){
      return this.errors.contact[element] = "";
    },
    handleFileUpload(event){
      if(event.target.files.length > 0) {
         this.company.catalogo_path = event.target.files[0];
      }
    }
  },
  mounted (){
    let _this = this;
    axios.post('/company/companytypes',{}).then(function(response){
      _this.types = response.data.data;
    });
    this.carousel =  $('.owl-carousel').owlCarousel({
      singleItem:true,
      mouseDrag: false,
      touchDrag: false,
      navigation : false,
      pagination : true,
      autoHeight: false,
      items: 1,
      slideSpeed: 800,
      autoplayTimeout: null
    });
  }
}
</script>