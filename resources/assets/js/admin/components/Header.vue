<template>
        <header id="basix-header" class="header">

            <div class="header-menu">
                <div class="row">
                    <div class="col-sm-7">

                        <div class="header-left" :class="{'open': isSearch, '': !isSearch }">
                           <!-- <button
                                class="search-trigger"
                                @click="searchClick"
                            >
                                <i class="fa fa-search"></i>
                            </button>

                            <div class="form-inline">
                                <form class="search-form">
                                    <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                    <button
                                        class="search-close"
                                        type="submit"
                                        @click="isSearch = !isSearch"
                                    ><i class="fa fa-close"></i></button>
                                </form>
                            </div>-->

                            <div class="dropdown for-notification">
                                <button
                                    style="color: #1b3c6d !important"
                                    class="btn btn-secondary dropdown-toggle"
                                    type="button"
                                    id="notification" data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    :class="{'notification-show': isNotification, '': !isNotification }"
                                    @click="handleNotification"
                                    autoClose= true
                                >
                                    <i class="fa fa-bell"></i>
                                    <span class="count bg-danger">{{messages.length}}</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="notification">
                                    <a class="dropdown-item media bg-flat-color-2 text-white" href="#" v-for="message in messages" v-bind:key="message.id">
                                        <p class="text-black">Ha recibido un mensaje de {{message.client.company.name}}</p>
                                    </a>
                                    <a class="dropdown-item media bg-flat-color-2 text-white" href="#" v-for="item in items" v-bind:key="item.id">
                                        <p class="text-black">Nuevo documento de {{item.client.company.name}}</p>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="user-area dropdown float-right">
                            <a href="#"
                                class="dropdown-toggle"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                :class="{'show': isActive, '': !isActive }"
                                @click="handleClick"
                            >
                                <img class="user-avatar rounded-circle" src="/images/admin.jpg" alt="User Avatar">
                            </a>

                            <div
                                class="user-menu dropdown-menu"
                                :class="{'show': isActive, '': !isActive }"
                                @click="handleClick"
                                >
                                <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                                <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                                <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                                <a class="nav-link"  href="#" @click="logout"><i class="fa fa-power -off"></i>Logout</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </header><!-- /header -->
</template>


<script>
const service = require('./../service/auth-service');
const DashboardService = require('./../service/dashboard-service');

export default {
    name: 'basix-header',
    data (){
      return{
        isActive: false,
        isFlag: false,
        isMessage: false,
        isNotification: false,
        isSearch: false,
        isOpen: false,
        notifications: 0,
        messages: {}
      }
    },
    created() {
        
        this.getNotifications();
        },
    mounted(){
    },
    methods: {
        getNotifications(){
            DashboardService.getMessages().then(response => this.messages = response.data); 
            DashboardService.index().then(response => this.items = response.data );
            
        },
        toggle(e){
            //this.isOpen = !this.isOpen
            e.target.parentElement.classList.toggle('close')
        },
        handleClick(e){
            this.isActive = !this.isActive;
            // if(e.target.className == "noclass"){
            //     e.target.className = "link active";
            // } else{
            //     e.target.className = "noclass";
            // }
        },
        searchClick (e) {
          this.isSearch = !this.isSearch;
        },
        handleMessage (e) {
          this.isMessage = !this.isMessage;
        },
        handleNotification (e) {
          this.isNotification = !this.isNotification;
        },
        handleFlag (e) {
          this.isFlag = !this.isFlag;
        },
        logout (e){
            service.logout().then(resp => {
               window.localStorage.clear();
                location.reload();
             })
            .catch(error => {
                console.error(error);
            })
        }
      }
    }
</script>

<style>
    header .form-inline .search-form button{
        cursor: pointer;
    }
</style>