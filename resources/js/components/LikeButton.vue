<template>
<div>
    <div class="heart"
    @click="likeReceta"
    :class="{'is_animating' : isActive}">
    </div>
    <p>{{this.cantidadlikes}} Personas le gusta esta receta</p>
</div>
</template>


<script>
export default {
    props:['recetaId','like','likes'],
    data (){
        return{

            totalLikes:this.likes,
            isActive:this.likes
        }
    },
    methods: {
        likeReceta(){

            axios.post('/recetas/' + this.recetaId)
            .then(respuesta =>{
               if(respuesta.data.attached.length > 0){
                   this.$data.totalLikes++
               }else{
                   this.$data.totalLikes--
               }

               this.isActive = !this.isActive
            })
            .catch(error =>{
                if(error.response.status === 401){
                    window.location = '/register'
                }
            })

        }
    },
    computed:{
        cantidadlikes (){
            return this.totalLikes
        }
    }
}
</script>
