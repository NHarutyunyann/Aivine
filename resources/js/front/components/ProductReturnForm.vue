<template>
    <form onsubmit="return false" class="file-letter-box">
        <div class="divSend">
            <label class="textProductInfo">
                Ապրանքի վերադարձը կարող եք ուղարկել EXCEL ֆայլի տարբերակով.<br>
                Պարտադիր տվյալներն են ապրանքի կոդը և քանակը (ապրանքի կոդը կարող եք տեսնել ապրանքի էջում).<br>
                Պարտադիր է նաև նշել վերադարձի պատճառը և վերդարձվող ապրանքի առաքման տարբերակը:
            </label>
            <input @change="fileUploadChanged" ref="fileUpload" type="file" />
            <span v-if="errors.file" class="error">{{ errors.file }}</span>

            <label class="textProductInfo">Երկխոսության պատուհան</label>
            <textarea v-model="message"></textarea>
            <span v-if="errors.message" class="error">{{ errors.message }}</span>
            <button @click="handleSubmitForm" class="SendButton">Ուղարկել</button>
        </div>

        <label v-if="productReturnFiles.length" class="textProductInfo history">Ուղարկված ֆայլերի պատմություն</label>
        <table v-if="productReturnFiles.length" class="tableSendFile">
            <tr>
                <th>Ուղարկելու ամսաթիվ</th>
                <th>Ֆայլի անվանում</th>
                <th></th>
            </tr>
            <tr v-for="item in productReturnFiles" :key="`return_file_${item.id}`">
                <td>{{ moment(item.created_at).format('DD.MM.yyyy H:mm') }}</td>
                <td class="downloadline"><v-clamp ellipsis="..." location="end" tag="span" autoresize :max-lines="1">{{ item.name }}</v-clamp><a :download="item.name" :href="item.file_url">Ներբեռնել</a></td>
            </tr>
        </table>
        <div v-if="productReturnFiles.length" class="buttonBox">
            <pagination :total="total" :per-page="perPage" :page="page" v-on:onPageChange="page = $event.page; loadProductReturnFiles()"/>
            <button class="addButton" @click="downloadAll">Ներբեռնել բոլորը</button>
        </div>


    </form>
</template>
<script>
import {mapActions} from "vuex";
import Pagination from "./Pagination";
import VClamp from 'vue-clamp';

export default {
    components: {
        Pagination,
        'v-clamp': VClamp
    },
    data() {
        return {
            file: null,
            message: '',
            errors: {},
            page: 1,
            perPage: 6,
            total: 0,
            productReturnFiles: [],
        }
    },
    beforeMount() {
        this.loadProductReturnFiles();
    },
    methods: {
        ...mapActions(['sendProductReturnFormEmail', 'getProductReturnFiles']),
        async handleSubmitForm() {
            this.errors = {};
            const formData = new FormData();
            if(this.file) {
                formData.append('file', this.file);
            }
            formData.append('message', this.message);

            const [error, data] = await this.sendProductReturnFormEmail(formData)

            if(error) {
                if(data && data.validation_errors) {
                    this.errors = data.validation_errors
                }
            } else {
                this.file = null;
                this.$refs.fileUpload.value = null;
                this.message = '';
                this.$store.dispatch('addNote', 'Հաղորդագրությունը հաջողությամբ ուղարկվել է');
            }

            this.page = 1;
            this.loadProductReturnFiles();
        },
        fileUploadChanged(event) {
            this.file = event.target.files[0]
        },
        loadProductReturnFiles() {
            this.getProductReturnFiles({page: this.page, perPage: this.perPage}).then(({items, total}) => {
                this.total = total;
                this.productReturnFiles = items;
            })
        },
        downloadAll() {
            this.getProductReturnFiles({page: 1, perPage: this.total + 1}).then(({items}) => {
                const tempLink = document.createElement("a");
                tempLink.style.display = 'none';

                document.body.removeChild( tempLink );
            })
        },
    }
}
</script>
