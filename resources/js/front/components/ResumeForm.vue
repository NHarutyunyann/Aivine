<template>
    <div :class="{loader: $store.getters.loading}">
        <label>Անուն (պարտադիր)</label>
        <input v-model="first_name" type="text" />
        <span v-if="errors.first_name" class="error">{{ errors.first_name }}</span>

        <label>Ազգանուն (պարտադիր)</label>
        <input v-model="last_name" type="text" />
        <span v-if="errors.last_name" class="error">{{ errors.last_name }}</span>

        <label>Հեռախոսահամար</label>
        <input v-model="phone_number" type="text" />
        <span v-if="errors.phone_number" class="error">{{ errors.phone_number }}</span>

        <label>Հաստիք</label>
        <select v-model="stuff" class="form-control">
            <option v-for="vacancy in vacancies" :value="vacancy.title">{{ vacancy.title }}</option>
        </select>
        <span v-if="errors.stuff" class="error">{{ errors.stuff }}</span>

        <label>Ռեզյումե</label>
        <input @change="fileUploadChanged" type="file" />
        <span v-if="errors.file" class="error">{{ errors.file }}</span>

        <label>Նշումներ</label>
        <textarea v-model="notes"></textarea>
        <span v-if="errors.notes" class="error">{{ errors.notes }}</span>

        <button @click="handleSubmitForm">ՈՒՂԱՐԿԵԼ</button>
    </div>
</template>
<script>
import {mapActions} from "vuex";

export default {
    props: ['vacancies'],
    data() {
        return {
            first_name: '',
            last_name: '',
            file: '',
            phone_number: '',
            stuff: '',
            notes: '',
            errors: {},
        }
    },
    methods: {
        ...mapActions(['sendResumeFormEmail']),
        async handleSubmitForm() {
            const formData = new FormData();
            formData.append('file', this.file);
            formData.append('first_name', this.first_name);
            formData.append('last_name', this.last_name);
            formData.append('phone_number', this.phone_number);
            formData.append('stuff', this.stuff);
            formData.append('notes', this.notes);

            const [error, data] = await this.sendResumeFormEmail(formData)

            if(error) {
                if(data && data.validation_errors) {
                    this.errors = data.validation_errors
                }
            } else {
                this.file = '';
                this.first_name = '';
                this.last_name = '';
                this.phone_number = '';
                this.stuff = '';
                this.notes = '';
                this.$store.dispatch('addNote', 'Հաղորդագրությունը հաջողությամբ ուղարկվել է');
            }
        },
        fileUploadChanged(event) {
            this.file = event.target.files[0]
        },
    }
}
</script>
