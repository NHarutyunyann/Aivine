<template>
    <div>
        <p>Sizes</p>
        <div class="sizes">
            <div v-for="size in this.propSizes" class="size">
                <input type="radio" :checked="propSize.map((x) => x.size).includes(size.size )" :value="size.size" class="btn-check ad" :id="size.size" :name="size.size" style=" width: 100%; height: 100%;">
                <label class="btn btn-default ad" :for="size.size">{{ size.size }}</label>
                <!-- <input type="number" :id="size.size" :value="propSize.find((x) => x.size == size.size propSize.pivot.stock)"  :name="size.size" class="quantity" min="0"> -->
                <input type="text" :id="size.size" :value="propSize.find((x) => x.size == size.size)?.pivot.stock" :name="`relations[sizes][${size.id}]`" class="quantity" min="0">
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['propSizes', 'propSize'],
    data() {
        console.log(this.propSize[0].pivot.stock)
        // console.log(this.propSize.map((x) => x.size ).includes(this.propSizes[1].size))
        return {
            checkedSize: '',
            quantity: 1
        }
    },
}

</script>

<style scoped>
.sizes {
    display: flex;
    /* justify-content:center; */
    flex-direction: row;
    width: auto;
    max-width: 100%;
    gap: 2px;
    flex-wrap: wrap !important;
}

.size {
    display: flex;
    flex-direction: column;
    width: 35px;
    gap: 5px;
    margin-top: 15px;
}

.quantity {
    width: 35px;
    height: 35px;
    padding-left: 3px;
    margin: 0 !important;
}

.add-btn {
    padding: 0;
}

.sizes input[type="radio"] {
    display: none;
}

.sizes label {
    display: flex;
    justify-content: center;
    background-color: #6885a9;
    color: white;
    padding: 4px 11px;
    font-size: 16px;
    cursor: pointer;
}

/* .sizes input:hover {
    background-color: #da00aa;
}
.sizes label:hover {
    background-color: #da00aa;
} */
.sizes input[type="radio"]:checked+label {
    background-color: #2271b1;
    color: white;
}

/* .ad:focus {
    background-color: #c7009d;
} */
</style>
