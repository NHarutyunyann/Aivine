<template>
    <div class="col-12">
        <label >Home page slider</label>
        <h3>Right side</h3>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">
                <a @click="addToList({image: '', position: '', href: ''})" href="javascript:" class="btn btn-info">+</a>
            </label>
            <div class="col-sm-9 input-group-sm">
                <div class="row mb-3" v-for="(item, index) in selectedImages">
                    <div class="col-10 mb-6" >
                        <h3>Slide {{ index + 1 }}</h3>
                    </div>
                    <div class="col-2 mb-3" >
                        <span class="remove-row" style="cursor: pointer; color: red" @click="removeFromList(index)">X</span>
                    </div>
                    <div class="col-12 mb-3" >
                        <label>Href</label>
                        <input type="text" class="form-control" v-model="selectedImages[index].href" :name="`${inputName}[${index}][href]`">
                    </div>
                    <div class="col-12 mb-3" >
                        <label>Position</label>
                        <input type="number" class="form-control" v-model="selectedImages[index].position" :name="`${inputName}[${index}][position]`">
                    </div>
                    <div class="col-6 mb-3">
                        <label>Image</label>
                        <media-uploader
                            :prop-input-name="`${inputName}[${index}][image]`"
                            prop-size="medium"
                            :prop-selected-attachments="[selectedImages[index].image]"
                            return-type="src.original"
                        ></media-uploader>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MediaUploader from "./MediaUploader";

export default {
    name: "slider-image-uploader",
    components: {MediaUploader},
    props: ['propSelectedImages', 'propInputName'],
    data() {
        let selectedImages = JSON.parse(this.propSelectedImages)
        if(!selectedImages.length) {
            selectedImages.push({image: '', position: '', href: '#'});
        }
        return {
            selectedImages: selectedImages,
            inputName: this.propInputName,
        }
    },
    methods: {
        addToList(item) {
            console.log('this.selectedImages', this.selectedImages)
            this.selectedImages.push(item ?? '')
        },
        removeFromList(index) {
            this.selectedImages.splice(index, 1)
        },
    }
}
</script>
