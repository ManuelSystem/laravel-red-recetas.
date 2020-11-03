<template>
    <div>
        <span
            class="like-btn"
            @click="likeReceta"
            :class="{ 'like-active': isActive }"
        ></span>
        <!--con esta class logro hacer, que si en caso de estar ya dado el like se mantenga, toma la clase like-active
        definido en el like.scss-->
        <p class="font-weight-bold ">
            {{ cantidadLikes }} Me gusta esta receta
        </p>
    </div>
</template>
<script>
export default {
    props: ["recetaId", "like", "likes"],
    data: function() {
        return {
            isActive: this.like,
            totalLikes: this.likes
        };
    },
    methods: {
        likeReceta() {
            axios
                .post("/recetas/" + this.recetaId)
                .then(result => {
                    if (result.data.attached.length > 0) {
                        this.$data.totalLikes++;
                    } else {
                        this.$data.totalLikes--;
                    }
                    this.isActive = !this.isActive;
                })
                .catch(err => {
                    if (err.response.status === 401) {
                        window.location = "/register";
                    }
                });
        }
    },
    computed: {
        cantidadLikes: function() {
            return this.totalLikes;
        }
    }
};
</script>
