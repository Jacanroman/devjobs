<template>
     <span 
        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full "
        :class="claseEstadoVacante()"
        @click="cambiarEstado"
        :key="estadoVacanteData"
     >
    <!-- Si es uno le agregar Activa si no Inactiva-->
        {{estadoVacante}}
    </span>
</template>

<script>
export default{
    props:['estado','vacanteId'],
    mounted(){
        //console.log(Number(this.estado));
        this.estadoVacanteData = Number(this.estado)
    },
    data: function(){
        return{
            estadoVacanteData: null
        }
    },
    methods:{
        claseEstadoVacante(){
            return this.estadoVacanteData === 1 ? "bg-green-100 text-green-800" : "bg-red-100 text-red-800"
        },
        
        cambiarEstado(){
            //console.log(this.estadoVacanteData);
            if(this.estadoVacanteData === 1) {
                this.estadoVacanteData = 0;
            }else{
                this.estadoVacanteData = 1;
            }

            //Enviar a axios
        }
    },

    computed: {
        estadoVacante(){
            return this.estadoVacanteData === 1 ? 'Activa' : 'Inactiva'
        }
    }
    
}
</script>
