<template>
<div class="card">
  <div class="card-header">
    <router-link class="btn btn-sm btn-primary" :to="{ name: 'question'}" >
      <i class="fa fa-arrow-left"></i>
    </router-link>
    Responder 
  </div>

  <div class="card-body">
    <div class="row">
      <div class="col-md-4">
        <label> Empresa : <span>{{item.client.company.name}}</span></label>
      </div>
      <div class="col-md-4 text-center">
        <label> Fecha : <span>{{item.created_at.date | date2 }}</span></label>
      </div>
      <div class="col-md-4"> 
        <div class="badge badge-pill badge-warning pull-right"   v-if="item.status == 'pendiente'">{{item.status }}</div>
        <div class="badge badge-pill badge-primary pull-right"  v-else>{{item.status }}</div>
      </div>
      <div class="col-md-12">
        <label>Pregunta : <span>{{item.question}}</span></label>
      </div>
    </div>
    <form @submit="sendForm" novalidate>
      <div class="form-group">
        <label for="type">Respuesta</label>
        <textarea 
          name="type" 
          class="form-control reply"
          v-model="reply.reply"
          :class="{ 'is-invalid': hashError('reply') }"
          @keyup="validateType('reply')"
          placeholder="Escribe la respuesta aqui!" >
          </textarea>
        <div class="invalid-feedback">
          {{errors.reply}}
        </div>
      </div>
      <button class="btn btn-primary" type="submit">Guardar</button>
    </form>
  </div> 
</div>
</template>

<script>

const service = require('./../../service/question-service');
const serviceReply = require('./../../service/reply-service');

export default {
  name: 'question-edit',
  components: { },
  data () {
    return {
      item: { question: '',client :{company:{ name: ''}},created_at: { data: '' } },
      reply: { reply: '' },
      errors: { reply: [] }
    }
  },
  methods:{
    hashError: function(element){
      return this.errors[element].length !== 0;
    },
    validateType: function(element){
      this.errors[element] = [];
      if(this.reply.reply === ''){
        this.errors.type.push('Debe Ingresar un valor');
      }
    },
    sendForm: function(form) {
      form.preventDefault();
      form.stopPropagation();
      let _this = this
      if(form.target.checkValidity()){
        serviceReply.save(this.reply,this.item)
        .then(response => {
          console.log(response.data.data);
          _this.reply = response.data.data;
          _this.item.status = 'procesada';
          alert("Respuesta Almacenada");
        })
        .catch(error=> _this.errors = error.response.data.errors);
      }
    }
  },
  mounted () {
    if(this.$route.params.id){
      service.getById(this.$route.params.id).then(response => {
        this.item = response.data.data
        if(this.item.reply != null){
          this.reply = this.item.reply;
        }
      });
    }
  }
}
</script>