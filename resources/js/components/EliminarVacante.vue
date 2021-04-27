<template>
    <button 
        class="text-red-600 hover:text-red-900  mr-5"
        @click="eliminarVacante"
    >Eliminar
    </button>
</template>

<script>
export default{

    props: ['vacanteId'],
    methods:{
       eliminarVacante(){
           console.log("eliminando...", this.vacanteId);
       }
    }
}
</script>