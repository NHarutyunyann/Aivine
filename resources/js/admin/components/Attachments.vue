<template>
    <div class="modal-content border-0 media-page">
        <div class="modal-header">
            <h4 class="modal-title">Media Library</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-6 mb-5">
                    <div class="upload-file-box form-group">
                        <label for="uploadFileLabel" class="uploadFileBox"><i class="fas fa-arrow-circle-up"></i> Upload File </label>
                        <input type="file" @change="uploadFile" id="uploadFileLabel" multiple>
                    </div>
                </div>
                <div class="col-6 mb-5 text-right">
                    <div class="search-box">
                        <input type="text" v-model="filters.search" v-on:keyup="filters.page = 1;applyFilters()" class="form-control" placeholder="Search" id="search">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col media-container">
                    <div class="row media-list">
                        <div class="mb-3 mt-3 col-2 media-item" v-for="(item, index) in files" v-bind:key="index + item.size">
                            <img class="w-100" loading="lazy" style="opacity: 0.5" :src="getAttachSrc(item.preview, 'base64')">
                        </div>
                        <div v-for="item in attachments" v-bind:key="item.id" v-on:click="currentAttachment = item" class="media-item" v-bind:class="{ active: currentAttachment && currentAttachment.id === item.id }">
                            <div class="media-item--inner">
                                <img class="w-100" loading="lazy" :src="getAttachSrc(item, 'medium')">
                                <button class="check">
                                    <span class="media-modal-icon"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3" style="border-left: 2px solid lightgrey;" v-if="currentAttachment">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <img :src="getAttachSrc(currentAttachment, 'medium')" style="width: 100%; max-height: 300px">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="attach_path">Url: </label>
                            <input id="attach_path" disabled type="text" placeholder="Title" class="form-control" v-model="currentAttachment.urls.original"/>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="attach_name">Title: </label>
                            <input id="attach_name" type="text" placeholder="Title" class="form-control" v-model="currentAttachment.name"/>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="attach_alt">Alt: </label>
                            <input id="attach_alt" type="text" placeholder="Alt" class="form-control" v-model="currentAttachment.alt"/>
                        </div>
                        <div class="col-12 mb-3">
                            <p>{{ moment(currentAttachment.created_at).format('LL') }}</p>
                            <p>{{ formatBytes(currentAttachment.size) }}</p>
                            <p v-if="currentAttachment.width && currentAttachment.height">{{ currentAttachment.width }} by {{ currentAttachment.height }} pixels</p>
                        </div>
                        <div class="col-12 mb-5">
                            <a class="btn btn-primary" v-on:click="updateAttachment">Save Media</a>
                            <a class="btn btn-danger" v-on:click="deleteAttachment">Delete Media</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <ul class="pagination pagination-sm mt-3 float-left">
                <li class="page-item" v-if="pageCount >= 7 && filters.page > 4">
                    <a class="page-link" @click="filters.page = 1;applyFilters()">
                        &laquo;
                    </a>
                </li>
                <li v-for="page of pages" v-if="pageCount !== 1" :key="page" v-bind:class="{ active: filters.page === page }" class="page-item">
                    <a class="page-link" @click="filters.page = page;applyFilters()">{{ page }}</a>
                </li>

                <li class="page-item" v-if="pageCount >= 7 && (pageCount - filters.page) > 4">
                    <a class="page-link" @click="filters.page = pageCount;applyFilters()">
                        &raquo;
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>

export default {
    name: "attachments",
    data() {
        return {
            files: [],
            attachments: [],
            currentAttachment: null,
            total: 0,
            pageCount: 0,
            pages: [],
            filters: {
                perPage: 40,
                page: 1,
                search: '',
            }
        }
    },
    mounted() {
        this.applyFilters()
    },
    methods: {
        toBase64(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader()
                reader.readAsDataURL(file)
                reader.onload = () => resolve(reader.result)
                reader.onerror = error => reject(error)
            })
        },
        async prepareFileToUpload(files) {
            const promises = []
            Object.values(files).map(file => {
                promises.push((async () => {
                    console.log('file: ', file)
                    const base64 = await this.toBase64(file);
                    const format = file?.name.split('.').reverse()[0];
                    file.preview = {
                        is_image: ['jpeg', 'png', 'jpg', 'webp'].includes(format),
                        base64,
                        format
                    }
                    return file
                })())
            })

            return await Promise.all(promises)
        },
        async uploadFile(event) {
            const newFiles = await this.prepareFileToUpload(event.target.files)

            this.files = [...newFiles, ...this.files]

            const iterate = async () => {
                const formData = new FormData()

                if(!this.files.length) {return}

                formData.append('attachment', this.files.splice(0, 1)[0])

                try{
                    const { data } = await axios.post('/admin/upload-file', formData)
                    if(!data || !data.item) {return}

                    this.attachments = [...[data.item], ...this.attachments]
                } catch (e) {console.error('ERROR: ', e)}

                if(this.files.length) {
                    await iterate()
                }
            }

            await iterate()
            await this.applyFilters()

        },
        async applyFilters(){
            this.currentAttachment = null
            const url = new URL(window.location.origin + '/admin/attachments')
            const params = url.searchParams

            Object.keys(this.filters).map(key => {
                if(this.filters[key]) {
                    params.set(key, this.filters[key])
                } else {
                    params.delete(key)
                }
            })

            url.search = params.toString()
            const newUrl = url.toString()

            const {data} = await axios.get(newUrl)

            this.attachments = data.items

            this.total = data.total

            this.renderPagination()
        },
        async updateAttachment(){
            await axios.put('/admin/attachments/' + this.currentAttachment.id, {
                name: this.currentAttachment.name,
                alt: this.currentAttachment.alt,
            }).then(res => {});
            this.applyFilters()
        },
        async deleteAttachment(){
            await axios.delete(`/admin/attachments/${this.currentAttachment.id}`)
            this.currentAttachment = null
            this.applyFilters()
        },
        renderPagination() {
            this.pageCount = Math.ceil(this.total / this.filters.perPage);
            this.pages = [];
            const pages = this.pageCount >= 7 ? 7 : this.pageCount;

            let pageOffset = this.filters.page > 4 ? this.filters.page - 4 : 0;

            pageOffset = (this.pageCount - this.filters.page) < 4 ? this.pageCount - 7 : pageOffset;

            if (pages < 7) {
                for (let i = 1; i <= this.pageCount; i++) {
                    this.pages.push(i);
                }
            }else {
                for (let i = (1 + pageOffset); i <= (pages + pageOffset); i++) {
                    this.pages.push(i);
                }
            }
        },
        getAttachSrc(attach, size = 'small') {
            if (size === 'base64') {
               return attach.is_image ? attach.base64 : '/images/format/image_' + attach.format + '.png';
            }
            return attach.is_image ? attach?.urls?.[size] : '/images/format/image_' + attach.format + '.png';
        },
        formatBytes(bytes, decimals = 2) {
            if (!bytes) return ''

            const k = 1024
            const dm = decimals < 0 ? 0 : decimals
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']

            const i = Math.floor(Math.log(bytes) / Math.log(k))

            return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
        },
    }
}
</script>
