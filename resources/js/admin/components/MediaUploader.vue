<style>
.modal-body {
    min-height: 750px;
}
.media-item.active img {
    border: 2px solid #2185d0;
}
.modal-dialog {
    max-width: 1229px;
}
.media-item {
    position: relative;
    width: 10%;
    padding-left: 8px;
    padding-right: 8px;
    margin-bottom: 16px;
}

.delete-link, .delete-link:active, .delete-link:focus {
    color: red;
}

@media screen and (max-width: 991px){
    .media-item {
        width: 20%;
    }
}
@media screen and (max-width: 767px){
    .media-item {
        width: 25%;
    }
}
.media-item .check {
    display: none;
    height: 24px;
    width: 24px;
    padding: 0;
    border: 0;
    position: absolute;
    z-index: 10;
    top: -12px;
    right: 0;
    outline: 0;
    background-color: #2271b1;
    box-shadow: 0 0 0 1px #fff, 0 0 0 2px #2271b1;
    margin: 5px;
}
.media-item .check .media-modal-icon  {
    width: 15px;
    height: 15px;
    display: block;
    background-image: url('/images/icons/uploader-icons-2x.png');
    background-size: 134px 15px;
    background-position: -21px 0;
    background-repeat: no-repeat;
    margin: 5px;
}
.media-item .check:hover .media-modal-icon {
    background-position: -60px 0;
}
.media-item.active .check {
    display: block;
}
.media-list {
    margin-left: -8px;
    margin-right: -8px;
    display: flex;
    flex-wrap: wrap;
}
.media-item img {
    position: relative;
    box-shadow: inset 0 0 15px rgb(0 0 0 / 10%), inset 0 0 0 1px rgb(0 0 0 / 5%);
    background: #f0f0f1;
    cursor: pointer;
}
.media-container {
    margin-left: 0;
    margin-right: 0;
}
.add-image-item, .full {
    width: 80px;
    position: relative;
    cursor: pointer;
}
@media screen and(max-width: 767px) {
    .add-image-item {
        width: 30%;
        margin: 0 auto;
    }
}
.add-image-item.small {
    width: 80px;
}

.add-image-item.full {
    width: 100%;
}
.media-item-box row {
    margin-left: -5px;
    margin-right: -5px;
}
.image-item {
    padding-left: 5px;
    padding-right: 5px;
    cursor: pointer;
}
.image-item:hover .remove-item, .add-image-item:hover .remove-item {
    display: inline-block;
}

.image-item img, .add-image-item img {
    width: 100%;
}
.remove-item {
    position: absolute;
    top: -4px;
    right: 0;
    text-align: center;
    height: 16px;
    width: 16px;
    font-size: 12px;
    color: #fff;
    line-height: 15px;
    background: rgb(153, 153, 153);
    border-radius: 50%;
    border: 2px solid #fff;
    box-sizing: content-box;
    cursor: pointer;
    display: none;
}
.remove-item:hover {
    background-color: #a00;
}
</style>
<template>
    <div class="media-item-box" :style="propMultiple ? 'padding: 8px; margin-bottom: 20px' : ''">
        <div class="row" v-if="propMultiple && propInputName !== 'tinymce'">
            <div class="image-item col-md-4 col-sm-6 mb-2" v-for="(attachment, index) in selectedAttachments">
                <input type="hidden" :name="`${propInputName}${propMultiple ? '[]' : ''}`" :value="attachment ? attachment.id : ''"/>
                <img loading="lazy"  v-if="attachment" :alt="attachment.alt" :src="getAttachSrc(attachment, 'medium')"/>
                <span class="remove-item" v-on:click="selectedAttachments.splice(index, 1)"><i class="fas fa-times"></i></span>
            </div>
        </div>
        <a
            v-if="propMultiple || propInputName === 'tinymce'"
            v-on:click="openModal"
            class="upload-media button btn-outline"
        >
            <span><i class="fas fa-photo-video"></i></span>
            {{ propButton }}
        </a>
        <div
            v-if="!propMultiple && propInputName !== 'tinymce'"
            class="add-image-item" :class="propSize"
        >
            <input type="hidden" :name="`${propInputName}`" :value="selectedAttachments[0] ? returnValue(selectedAttachments[0]) : ''"/>
            <img loading="lazy" v-on:click="openModal" v-if="selectedAttachments[0]" :alt="selectedAttachments[0].alt" :src="getAttachSrc(selectedAttachments[0], 'medium')"/>
            <img loading="lazy" v-on:click="openModal" v-if="!selectedAttachments[0]" src="/images/upload.png"/>
            <span v-if="selectedAttachments[0]" v-on:click="() => { selectedAttachments[0] ? selectedAttachments.splice(0, 1) : null}" class="remove-item"><i class="fas fa-times"></i></span>
        </div>
        <div class="modal fade show" style="display: block; padding-right: 17px;" id="modal-xl" v-if="modal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content border-0">
                    <div class="modal-header">
                        <h4 class="modal-title">Product image</h4>
                        <button type="button" class="close" v-on:click="modal=false" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 mb-5">
                                <div class="upload-file-box">
                                    <label for="uploadFileLabel"> Upload File</label>
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
                                        <img class="w-100" loading="lazy" style="opacity: 0.5" :src="item.preview">
                                    </div>
                                    <div v-for="item in attachments" v-bind:key="item.id" v-on:click="selectFile(item)" class="media-item" v-bind:class="{ active: isSelected(item) }">
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
                                        <a class="delete-link" href="javascript:" v-on:click="deleteAttachment">Delete</a>
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
                        <a class="btn" v-on:click="attachFiles()">Close</a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div v-if="modal" class="modal-backdrop fade show"></div>
    </div>
</template>

<script>
export default {
    name: 'media-uploader',
    props: {
        propInputName: {
            type: String,
            default: 'attachment'
        },
        returnType: {
            type: String,
            default: 'id'
        },
        propSize: {
            type: String,
            default: 'small'
        },
        propButton: {
            type: String,
            default: 'Attach Media'
        },
        propMultiple: {
            type: Boolean,
            default: false
        },
        propSelectedAttachments: {
            type: Array,
            default: () => ([])
        }
    },
    data() {
        return {
            modal: false,
            files: [],
            attachments: [],
            selectedAttachments: this.propSelectedAttachments.filter(i => i),
            currentAttachment: null,
            total: this.propTotal,
            pageCount: 0,
            pages: [],
            filters: {
                perPage: 30,
                page: 1,
                search: '',
            }
        }
    },
    methods: {
        openModal() {
            this.applyFilters()
            this.modal = true
        },
        isSelected(item) {
            return !!this.selectedAttachments.find(i => i.id === item.id)
        },
        selectFile(selected) {
            const isSelected = !!this.selectedAttachments.find(item => item.id === selected.id)

            if(isSelected) {
                this.currentAttachment = null
                this.selectedAttachments = this.selectedAttachments.filter(item => item.id !== selected.id)
            } else {
                if(this.propMultiple) {
                    this.selectedAttachments.push(selected)
                } else {
                    this.selectedAttachments = [selected]
                }

                this.currentAttachment = selected
            }

            try {
                if(this.propInputName === 'tinymce' && this.selectedAttachments[0] && tinymce && tinymce.activeEditor) {
                    let newNode = tinymce.activeEditor.getDoc().createElement ( "img" )
                    newNode.src = `/storage/media/${this.selectedAttachments[0].path}.${this.selectedAttachments[0].format}`
                    tinymce.activeEditor.execCommand('mceInsertContent', false, newNode.outerHTML)
                }
            } catch (e) {
                console.error(e)
            }
        },
        attachFiles() {
            this.modal = false
        },
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
                    file.preview = await this.toBase64(file)
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
            })

            this.applyFilters()
        },
        async deleteAttachment(){
            await axios.delete('/admin/attachments/' + this.currentAttachment.id);

            this.currentAttachment = null;

            this.applyFilters()
        },
        formatBytes(bytes, decimals = 2) {
            if (!bytes) return ''

            const k = 1024
            const dm = decimals < 0 ? 0 : decimals
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']

            const i = Math.floor(Math.log(bytes) / Math.log(k))

            return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
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
            return typeof attach === 'string' ? attach : (attach?.urls?.[size] || '/images/format/image_' + attach.format + '.png')
            // return attach.is_image ? attach?.urls?.[size] : '/images/format/image_' + attach.format + '.png';
        },
        returnValue(attachment) {
            switch (this.returnType) {
                case 'id' :
                    return attachment.id;
                case 'src.original':
                    return typeof attachment === 'string' ? attachment : attachment.urls.original
                case 'src.large':
                    return typeof attachment === 'string' ? attachment : attachment.urls.large
                case 'src.small':
                    return typeof attachment === 'string' ? attachment : attachment.urls.small
                case 'src.medium':
                    return typeof attachment === 'string' ? attachment : attachment.urls.medium
            }
        },
    }
}
</script>
