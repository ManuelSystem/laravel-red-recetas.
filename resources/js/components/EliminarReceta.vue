<template>
    <input
        type="submit"
        class="btn btn-danger d-block w-100 mb-2"
        value="Eliminar×"
        @click="eliminarReceta"
    />
</template>
<script>
export default {
    props: ["recetaId"],
    methods: {
        eliminarReceta() {
            //con esto se genera la alert de confirmación
            this.$swal({
                title: "¿Deseas eliminar esta receta?",
                text: "Una vez eliminada, no se puede recuperar!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "No"
            }).then(result => {
                if (result.isConfirmed) {
                    const params = {
                        id: this.recetaId
                    };
                    //enviar petición al servidor, de esta manera comunicó el back con Vue, utilizando axius, sweet y Vue
                    axios
                        .post(`/recetas/${this.recetaId}`, {
                            params,
                            _method: "delete"
                        })
                        .then(respuesta => {
                            this.$swal({
                                title: "Receta Eliminada!",
                                text: "Se eliminó la receta",
                                icon: "success"
                            });
                            //eliminar la receta del DOM
                            this.$el.parentNode.parentNode.parentNode.removeChild(
                                this.$el.parentNode.parentNode
                            );
                        })
                        .catch(err => {
                            console.log(err);
                        });
                }
            });
        }
    }
};
</script>
