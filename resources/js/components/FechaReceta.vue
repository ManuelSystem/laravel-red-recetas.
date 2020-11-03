<!--se genera la etiqueta template, la cual todo lo que vaya dentro de esta es lo que será visible-->
<template>
    <span>{{ formatearFecha }}</span>
</template>
<script>
export default {
    props: ["fecha"],
    mounted() {
        console.log("el componente esta listo");
    },
    computed: {
        formatearFecha() {
            return moment(this.fecha)
                .locale("es")
                .format("DD [de] MMMM [del] YYYY");
        }
    }
};
</script>
