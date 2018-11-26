<template>
    <div class="card">
        <div class="card-header">
            Calendario de citas
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <calendar-view
                        :show-date="showDate"
                        :events="events"
                        :enable-drag-drop="true"
                        @click-event="eventClicked"
                        @drop-on-date="onDrop"
                        class="theme-default">
                        <calendar-view-header
                            slot="header"
                            slot-scope="t"
                            :header-props="t.headerProps"
                            @input="setShowDate" />
                    </calendar-view>
                    <small>Si desea cambiar una cita de fecha arrastrela a la nueva fecha o haga click en modificar.</small>
                </div>
                <div class="col-md-4">
                    
                    <div v-if="eventSelected != ''" class="alert alert-info">
                        {{eventSelected.title}}<br>
                        <button @click="isModfying = true" v-if="!isModfying" class="btn btn-primary btn-sm">Modificar datos de encargado</button>
                        <div v-if="isModfying">
                            <label for="">Encargado</label>
                            <input type="text" v-model="updateEvent.attendant">
                            <label for="">Email del encargado</label>
                            <input type="text" v-model="updateEvent.attendant_mail">
                            <label for="">Numero del encargado</label>
                            <input type="text" v-model="updateEvent.attendant_phone">
                            <button class="btn btn-primary btn-sm" @click="modifyEvent"> <i class="fa fa-spin fa-spinner" v-if="isLoading"></i> Guardar</button>
                            <button class="btn btn-primary btn-sm" @click="isModfying = false">Descartar</button>
                        </div>
                        <div v-if="modified" class="alert alert-success">
                            Se ha modificado correctamente
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { CalendarView, CalendarViewHeader, CalendarMathMixin } from "vue-simple-calendar"
    const DatesService = require('./../service/dates-service');
    var moment = require('moment');
    
	require("vue-simple-calendar/static/css/default.css")
	require("vue-simple-calendar/static/css/holidays-us.css")

	export default {
        name: 'app',
        mixins: [CalendarMathMixin],
		data () {
            return { 
                showDate: new Date(),
                events:[],
                eventSelected: '',
                updateEvent: {},
                isModfying: false,
                modified: false,
                isLoading: false
            }
		},
		components: {
			CalendarView,
			CalendarViewHeader,
        },
        mounted () {
            DatesService.index()
            .then(response => {
                this.events = response.data;                
                console.log(this.events);
            });
            
            
        },
		methods: {
			setShowDate(d) {
				this.showDate = d;
            },
            eventClicked: function(e) {
                this.eventSelected = e;
                console.log(e);                
                DatesService.getOnlyOne(this.eventSelected).then(response => {
                    this.updateEvent = response.data;
                });
            },
            onDrop: function(event, date){
                /*               
                for(var e in this.events){
                    console.log(e);
                    
                    if (e.title == ev.title) {
                        console.log(true);
                        
                        e.startDate = date;
                        break;
                    }
                }*/
                const eLength = this.dayDiff(event.startDate, date);
                event.originalEvent.startDate = this.addDays(event.startDate, eLength);
                date = moment(date).format("YYYY-MM-DD"); 
                DatesService.updateDate(event, date).then(response =>{
                });
            },
            modifyEvent: function(){
                this.isLoading = !this.isLoading;
                var data = this.updateEvent;
                DatesService.updateAttendant(data).then(response => {
                    this.isModfying = false;
                    this.modified = true;
                    this.isLoading = !this.isLoading;
                });
                setTimeout(function(){ this.modified = false; }, 4000);
            }
		}
	}
</script>

<style>
.purple{
    background-color: #f0e0ff;
    border-color: #e7d7f7;
}
.orange{
    background-color: #FFB300;
    border-color: #FFC107;
}/*Agregar otras clases*/
.red{
    background-color: #C62828 !important;
    border-color: #D32F2F !important;
    color: white !important;
}
</style>
