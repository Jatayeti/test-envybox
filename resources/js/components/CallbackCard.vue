<template>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{callback.name}}</h5>
            <p class="card-text">{{callback.phone}}</p>
            <p class="card-text" v-html="callback.message"></p>
            <button type="button" @click="deleteCallback(callback.id)" class="btn btn-danger">Удалить</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CallbackCard",

        props: ['callback'],

        methods: {
            deleteCallback(id) {
                axios.delete(`callbacks/${id}`)
                    .then( () => {
                        this.$emit('deleted')
                    })
            }
        }
    }
</script>

<style scoped>

</style>
