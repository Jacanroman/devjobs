<template>
    <div>
        <ul class="flex flex-wrap justify-center">
            <li
                class="border border-gray-500 px-10 py-3 mb-3 rounded mr-4"
                :class="verificarClaseActiva(skill)"
                v-for="(skill, i) in this.skills"
                v-bind:key="i"
                v-on:click="activar($event)"
            >{{skill}}</li>
        </ul>

        <input type="hidden" name="skills" id="skills">
    </div>
</template>

<script>

    export default {
        props: ['skills', 'oldskills'],
        mounted(){
            console.log(this.skills)
        },
        data: function(){
            return{
                habilidades: new Set()
            }
        },
        created: function(){
            //para marcar las skills que seleccionamos
            if(this.oldskills){
                const skillsArray = this.oldskills.split(',');
                //lo almacenamos en un array
                //console.log(skillsArray);
                skillsArray.forEach(skill => this.habilidades.add(skill));
            }
        },
        mounted: function(){
            console.log(this.oldskills);
            //asignar al input hidden
            document.querySelector('#skills').value = this.oldskills;
        },
        methods:{
            activar(e){
                //console.log('diste clik',e.target.textContent);
                //le agregamos una clase 
                if(e.target.classList.contains('bg-blue-400')){
                    //El skill esta activo    
                    e.target.classList.remove('bg-blue-400')

                    //Eliminar el set de habilidades
                    this.habilidades.delete(e.target.textContent);
                }else{
                    e.target.classList.add('bg-blue-400');

                    //Agregar al Set de habilidades
                    this.habilidades.add(e.target.textContent);
                }

                //Agregar la habilidades al input hiddeen
                const stringHabilidades = [...this.habilidades];
                document.querySelector('#skills').value = stringHabilidades;
            },
            verificarClaseActiva(skill){
                //console.log(skill);

                return this.habilidades.has(skill) ? 'bg-blue-400' : '';
            }
        }
    }
</script>