<template>
    <router-link class="btn btn-sm btn-primary float-left" :to="{ name: url }"   :title="title"> 
        <i class="fa fa-plus"></i>
    </router-link>
</template>

<script>
  export default {
    name: 'add-component',
    props: ['url','title']
  }
</script>