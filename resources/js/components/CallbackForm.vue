<template>
    <form @submit.prevent="submit">
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text"
                   class="form-control"
                   :class="{'is-invalid': errors.name}"
                   id="name"
                   v-model="name"
            >
            <div class="invalid-feedback" v-if="errors.name">
                {{errors.name[0]}}
            </div>
        </div>
        <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="phone"
                   class="form-control"
                   :class="{'is-invalid': errors.phone}"
                   id="phone"
                   v-model="phone"
            >
            <div class="invalid-feedback" v-if="errors.phone">
                {{errors.phone[0]}}
            </div>
        </div>
        <div class="form-group">
            <label for="message">Сообщение</label>
            <textarea class="form-control"
                      :class="{'is-invalid': errors.message}"
                      id="message"
                      rows="5"
                      v-model="message"
            ></textarea>
            <div class="invalid-feedback" v-if="errors.message">
                {{errors.message[0]}}
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</template>

<script>
    export default {
        name: "CallbackForm",

        data() {
            return {
                name: '',
                phone: '',
                message: '',
                errors: {}
            }
        },

        methods: {
            submit() {
                let form = new FormData
                form.set('name', this.name)
                form.set('phone', this.phone)
                form.set('message', this.message)

                axios.post('/callbacks', form)
                    .then(({data}) => {
                        this.name = ''
                        this.phone = ''
                        this.message = ''
                        this.errors = {}

                        this.$emit('created', data.callback)
                    })
                    .catch(errors => {
                        this.errors = errors.response.data.errors
                    })
            }
        }
    }
</script>

<style scoped>

</style>
