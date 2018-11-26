<template>

    <div class="navbar-header" @click="handleSidebarToggle">
        <button
            @click="mainmenuToggle"
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#main-menu"
            aria-controls="main-menu"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <i class="fa fa-bars"></i>
        </button>
        <router-link to="/" class="navbar-brand" exact>
            <img src="/images/KraftHeinz.svg.png" alt="Logo">
        </router-link>

        <router-link to="/" class="navbar-brand hidden">
            <img src="/images/logo2.png" alt="Logo">
        </router-link>

        <sidebar-collapse></sidebar-collapse>

    </div>

</template>
<script>
import SidebarCollapse from './SidebarCollapse.vue';

export default {
	name: 'sidebar-header',
        components: { SidebarCollapse },
    data(){
        return{
            clickable: true
        }
    },
	methods: {
        handleSidebarToggle(e){
            // if( this.clickable ){
            //     this.clickable = false;
            //     document.body.classList.toggle('open');
            //     this.clickable = true;
            // }

            e.target.parentElement.classList.toggle('collapsed')
        },

        mainmenuToggle(){
            if( this.clickable ){
                this.clickable = false;
                document.body.classList.toggle('mobile-menu');
                //e.target.childElement.classList.toggle('collapsed')
                this.clickable = true;
            }
        }


	  }
}
</script>

<style lang="scss" scoped>
    .navbar {
        .navbar-brand{
            justify-content: flex-start;
            padding-left:10%;
        }
    }

</style>