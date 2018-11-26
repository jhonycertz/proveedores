<template>
<div class="card">
  <div class="card-header"> 
    <router-link class="btn btn-sm btn-primary" :to="{ name: 'companies-news'}" v-if="item.status==='ESPERA'">
      <i class="fa fa-arrow-left"></i>
    </router-link>

    <router-link class="btn btn-sm btn-primary" :to="{ name: 'companies-en-proceso'}" v-if="item.status==='EN-PROCESO'">
      <i class="fa fa-arrow-left"></i>
    </router-link>

    <router-link class="btn btn-sm btn-primary" :to="{ name: 'companies-rehazada'}" v-if="item.status==='RECHAZADA'">
      <i class="fa fa-arrow-left"></i>
    </router-link>

    <router-link class="btn btn-sm btn-primary" :to="{ name: 'companies-aprobadas'}" v-if="item.status==='APROBADA'">
      <i class="fa fa-arrow-left"></i>
    </router-link>
    Empresa  
  </div>
  <div class="card-body">

    <b-tabs card>
      <b-tab title="Empresa" active>
        <div class="card-body">
          <div class="col-md-6" v-if="item">
            <p class="font-weight-bold">Nombre : {{ item.name }}</p>
            <p class="font-weight-bold">Identidad : {{ item.identity }}</p>
            <p class="font-weight-bold">Direcciòn : {{ item.address }}</p>
            <p class="font-weight-bold">Telefono : {{ item.phone }}</p>
            <p class="font-weight-bold">Correo : {{ item.email }}</p>
            <p class="font-weight-bold" v-if="item.company_type">Tipo : {{ item.company_type.type }}</p>
            <p class="font-weight-bold">Estado : {{ item.status }}</p>
            <p v-if="item.status == 'ESPERA'">
              <button class="btn btn-danger" v-on:click="rechazar" type="button">Reprobar</button>
              <button class="btn btn-primary" v-on:click="aprobar" type="button">Aprobar</button>
            </p>
          </div>
          <div class="col-md-6">
            <embed  v-bind:src="item.catalogo_path" width="100%" height="500px" type='application/pdf'>
          </div>
        </div>
      </b-tab>
      <b-tab title="Documentos" >
           <b-tabs pills card vertical nav-wrapper-class="w-25">
            <b-tab :title="`${i.code} ${i.name}`" v-for="i in item.company_type.requeriments" :key="i.id" v-if="charge == 0 || i.requeriment_type_id == charge">
              <div class="pb-2" v-for="d in item.documents" :key="d.id">
                <div v-if="d.requeriment.id == i.id" style="margin-bottom: 2px;border-bottom: 2px solid;">
                  <b-btn v-b-modal.modal-center class="mb-2" v-if="d.status != 'RECHAZADO' && d.status != 'PENDIENTE'" @click="setDoc(d)">Agregar Incidencia</b-btn>
                <p v-for="i in item.incidences" :key="i.id">Documento Rechazado: {{i.description}} </p>
                  <div v-if="seeDoc == true">
                    <embed v-bind:src="d.file_path.replace('storage/storage', 'storage')" width="100%" height="500px" type='application/pdf'>
                    <div v-if="d.status == 'PENDIENTE'">
                      <b-btn @click="accept(d)"> Aceptar</b-btn>
                      <b-btn @click="reject(d)"> Rechazar</b-btn>
                    </div>
                    <div v-else-if="d.status == 'ACEPTADO'" class="alert alert-success">
                      <h4>Este documento ha sido aceptado</h4>
                    </div>
                    <div v-else-if="d.status == 'RECHAZADO'" class="alert alert-danger">
                      <h4 class="">Este documento ha sido rechazado</h4>
                    </div>
                  </div>
                </div>
              </div>
              <b-modal id="modal-center" ref="inciModal" centered title="Registrar incidencia" ok-only ok-title="guardar"  @ok="guardar($event, currentDocument.id)" style="z-index: 10000000" @hidden="onHidden">
                  <form @submit="sendForm" novalidate class="mt-1">
                        <div class="form-group">
                          <label for="type">Incidencias</label>
                          <textarea class="form-control type" v-model="incidencia.description"> </textarea>
                          <div class="invalid-feedback">
                            {{errors}}
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="type">Tipo Incidencias</label>
                          <select  class="form-control type" v-model="incidencia.tipo">
                            <option v-for="option in incidencias" v-bind:value="option.id" :key="option.id">
                              {{ option.type }}
                            </option>
                          </select>
                          <div class="invalid-feedback">
                            {{errors}}
                          </div>
                        </div>
                  </form>
                </b-modal>
            </b-tab>
          </b-tabs>
       </b-tab>
        <b-tab title="Aprobaciones" v-if="charge == 0">
              <div class="pb-2" >
                <div class="pb-2" v-if="item.status == 'EN-PROCESO'">
                  <b-btn v-b-modal.aprobarEmpresa  v-if="item.status==='EN-PROCESO' && this.usuario.role_id == 1 ">Aprobar Empresa</b-btn> 
                </div>
                <ul class="list-group">
                  <li class="list-group-item" v-for="i in item.aprobaciones" :key="i.id" >Aprobado por : {{ i.user.name }}&nbsp;{{i.user.surname}}
                    <small class="float-right">fecha: {{fecha(i) }}</small>
                  </li>
                </ul>
                <b-modal id="aprobarEmpresa" ref="aprobarEmpresa" centered title="Aprobar Empresa" ok-only ok-title="Aprobar Empresa"  @ok="aprobarEmpresa($event)">
                  <h4 style="margin-bottom: 1em; text-align: -webkit-center;"> Complete el formulario para aprobar la empresa y generar una cita.</h4>
                  <div class="form-group">
                    <label for="">Fecha de la cita:</label>
                    <datepicker :format="format" v-model="dateSelected" :value="String" :disabledDates="disabledDates" :input-class="'form-control type'" @selected="dateError = false"></datepicker>
                    <div style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;" v-if="dateError == true">
                      Por favor ingrese un nombre correcto
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="">Cita a cargo de:</label>
                    <input type="text" v-model="formData.attendant" maxlength="60" minlength="3" class="form-control type"  @keyup="validateForm()">
                    <div style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;" v-if="attendantError == true">
                      Por favor ingrese un nombre correcto
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="">Correo de contacto:</label>
                    <input type="text" v-model="formData.attendantMail" maxlength="60" minlength="3" class="form-control type"  @keyup="validateForm()">
                    <div style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;" v-if="attendantEmailError == true">
                      Por favor ingrese un nombre correcto
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="">Numero de contacto:</label>
                    <input type="text" v-model="formData.phone" maxlength="20" minlength="3" class="form-control type"  @keyup="validateForm()">
                    {{formData.phone}}
                    <div style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #dc3545;" v-if="phoneError == true">
                      Por favor ingrese un numero de telefono correcto
                    </div>
                  </div>
                </b-modal>

              </div>
        </b-tab>
    </b-tabs>
  </div>
</div>
</template>

<script>
import AddComponent from '../../components/AddComponent.vue'
import Datepicker from 'vuejs-datepicker'
const service = require('./../../service/company-service');
const serviceIncidence = require('./../../service/incidence-type-service');
const serviceAuth = require('./../../service/auth-service');
var moment = require('moment');


export default{
  name: 'comprany-type-detail',
  components: { AddComponent, Datepicker },  
  data () {
    return {
      puebeAprobar: true,
      usuario:{ role_id:  0},
      item: {
        documents: [],
        aprobaciones: [],
        company_type: { requeriments: [] }
      },
      fields: [
      ],
      errors: [],
      incidencias: [],
      incidencia: {
        description: ''
      },
      currentDocument: 0,
      seeDoc: true,
      charge: 0,
      disabledDates: {},
      dateSelected: '',
      formData:{
        dateNow: '',
        attendant: '',
        attendantMail: '',
        phone: '',
        companyMail: ''
      },
      disabledDates: {
          to: new Date(Date.now() - 8640000)
        },
        dateError: false,
        attendantError: false,
        attendantEmailError: false,
        phoneError: false
    }
  },
  methods:{
    printDate: function(){
      console.log(this.dateSelected, "YYYY-MM-DD");
      
    },
    format(date) {
      this.formData.dateNow = moment(date).format("YYYY-MM-DD");
      
          return moment(date).format("YYYY-MM-DD");
      },
    /*
    Hecho por 4boot
    */
   accept: function(document){
     console.log(document);
     service.acceptDocument(document).then(r =>{
       service.getIdFull(this.$route.params.id)
       .then(response => {
         this.item = response.data.data
       });
     });
     this.callMounted();
   },
   reject: function (document) {
    service.rejectDocument(document).then(r =>{
      service.getIdFull(this.$route.params.id)
      .then(response => {
        this.item = response.data.data
      });
     });
     this.callMounted();
   },
   setDoc: function(doc){
     this.currentDocument = doc;
     this.seeDoc = false;
   },
  onHidden: function(){
    this.seeDoc = true;
  },
    /*Fin Hecho por 4boot*/

    fecha(i){
     return moment(i.created_at.date,'YYYY-MM-DD').format('YYYY-MM-DD');    
    },
    validateForm: function(){
      if (this.formData.dateNow == '' || this.formData.dateNow == null) {
        this.dateError = true;
      }else{
        this.dateError = false;
      } 
      if (this.formData.attendant  == '' || this.formData.attendant.length < 3 || this.formData.attendant.length > 60){
        this.attendantError = true;
      } else{
        this.attendantError = false
      } 
      if (this.formData.attendantMail  == '' || this.formData.attendantMail.length < 3 || this.formData.attendantMail.length > 60){
        this.attendantEmailError = true;
      }else{
        this.attendantEmailError = false;
      }
      if (this.formData.phone  == '' || this.formData.phone.length < 3 || this.formData.phone.length > 60){
        this.phoneError = true;
      }else{
        this.phoneError = false;
      }
    },
    aprobarDocumento: function( event){
      event.preventDefault();
      console.log( event, this.$refs.aprobarDocumento);
      service.aprobarDocumento(this.item).then (r => {
          service.getByIdFull(this.$route.params.id)
          .then(response => {
            this.item = response.data.data
          });
      });
      this.$refs.aprobarDocumento.hide();
    },
    aprobarEmpresa: function( event){
      console.log(this.item);
      
      this.validateForm();
      if (!this.dateError && !this.attendantError && !this.attendantEmailError && !this.phoneError) {
        service.aprobarEmpresa(this.item).then (r => {
            service.getByIdFull(this.$route.params.id)
            .then(response => {
              this.item = response.data.data
            });
        });
        this.formData.company = this.item.id;
        this.formData.companyMail = this.item.email;
        console.log(this.formData);        
        service.createDate(this.formData).then(response => console.log("done"));
        this.$refs.aprobarEmpresa.hide();
        window.history.back();
      }else{
        console.log('qlq menor');        
      }
    },
    guardar: function(event, i){
      event.preventDefault();
      serviceIncidence.save(i.incidence_path, i , this.incidencia).then(r => {
          console.log(r);
      });
      alert('Incidencia guardada correctamente');
    },
    aprobar: function(element){
      if (confirm('Esta seguro de aprobar esta empresa ')) {
        service.procesar(this.item).then(r => {
          this.item = r.data.data;
        });
      }
    },
    rechazar: function(element){
      if (confirm('Esta seguro de reprobar esta empresa ')) {
        service.reprobar(this.item).then(r => {
          this.item = r.data.data;
        });
      }
    },
    sendForm: function(form) {
      form.preventDefault();
      form.stopPropagation();
  },
    callMounted: function(){
        this.charge = localStorage.getItem('charge');
        //this.charge = 3;
    serviceAuth.usuario().then( data => {
      this.usuario = data.data;
      service.getByIdFull(this.$route.params.id)
      .then(response => {
        this.item = response.data.data;
        for( let i = 0; i < this.item.aprobaciones.length; i++){
          let valor = this.item.aprobaciones[ i];
          console.log( this.usuario.id, '===', valor.user.id )
          if( this.usuario.id === valor.user.id ){
            this.puebeAprobar = false;
          }
        }
      });
    });
    serviceIncidence.indexAll()
    .then( (data)=>{
      this.incidencias = data.data;
    });
  }
  },
  mounted () {
    this.callMounted();
  }
}
</script>