<template>
    <span v-text="formatearfecha"></span>
</template>

<script>
    export default {
        props:['fecha'],

        computed:{
            formatearfecha(){
                return moment(this.fecha).locale('es').format('DD [DE] MMMM [DE] YYYY')
            }
        }
    }
</script>
