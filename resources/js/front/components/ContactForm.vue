<template>
    <div :class="{loader: $store.getters.loading}">
        <label>Անուն <span class="red-span">*</span></label>
        <input v-model="name" :class="{'form-error': errors.name}" type="text"/>
        <span v-if="errors.name" class="error change-red">{{ errors.name }}</span>

        <label>Էլ․ հասցե <span class="red-span">*</span></label>
        <input v-model="email" @input="onEmailInput" :class="{'form-error':errors.email}" type="text" />
        <span v-if="errors.email" class="error change-red">{{ errors.email }}</span>

        <label>Թեմա</label>
        <input v-model="title" type="text" />
        <span v-if="errors.title" class="error">{{ errors.title }}</span>

        <label>Նամակ</label>
        <textarea v-model="message"></textarea>
        <span v-if="errors.message" class="error">{{ errors.message }}</span>

        <div class=""><button @click="handleSubmitForm" class="send-button">ՈՒՂԱՐԿԵԼ</button></div>
    </div>
</template>
<script>
import {mapActions} from "vuex";

export default {
    data() {
        return {
            name: null,
            email: null,
            title: null,
            message: null,
            errors: {},
        }
    },
    methods: {
        ...mapActions(['sendContactFormEmail']),
        validateEmail(email) {
            return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email);
        },
        onEmailInput($event) {
            const isValid = this.validateEmail($event.target.value);
            this.errors = {...this.email, ...{email: isValid ? null : 'Էլ. հասցեի դաշտը չի կարող լինել դատարկ'}}
        },
        async handleSubmitForm() {

            const [error, data] = await this.sendContactFormEmail({
                name: this.name,
                email: this.email,
                title: this.title,
                message: this.message,
            })

            if(error) {
                if(data && data.validation_errors) {
                    this.errors = data.validation_errors
                }
            } else {
                this.name = null;
                this.email = null;
                this.title = null;
                this.message = null;
                this.$store.dispatch('addNote', 'Հաղորդագրությունը հաջողությամբ ուղարկվել է');
            }
        }
    }
}
</script>
