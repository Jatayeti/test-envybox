<template>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h3 class="mb-4">Форма обратной связи</h3>
                <callback-form @created="callbacks.unshift($event)"/>
            </div>
            <div class="col-6">
                <h3 class="mb-4">Сообщения</h3>
                <callback-card v-for="(callback, i) in callbacks"
                               :key="i"
                               :callback="callback"
                               @deleted="callbacks.splice(i, 1)"
                />
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Callbacks",

        data() {
            return {
                callbacks: []
            }
        },

        mounted() {
            axios.get('/callbacks')
                .then(({data}) => {
                    this.callbacks = data.callbacks
                })
        }
    }
</script>

<style scoped>

</style>
