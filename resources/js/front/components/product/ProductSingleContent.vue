<template>
    <div>
        <div>
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="row gx-4 gx-lg-5 ">
                        <div class="col-md-6">
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                        class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                        aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                        aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img :src="'/storage/media/' + product.main_image.path + '.' + product.main_image.format"
                                            class="d-block w-100" alt="image">
                                    </div>
                                    <div v-for="img in product.attachments" class="carousel-item">
                                        <img :src="'/storage/media/' + img.path + '.' + img.format" class="d-block w-100"
                                            alt="image">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" style="margin-left: -25px" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"
                                        style="background-color: #c7009d; border-radius:8px"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" style="margin-right: -25px" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"
                                        style="background-color: #c7009d; border-radius:8px"></span>
                                    <span class="visually-hidden ">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <h4>{{ product.title }} </h4>
                            </div>
                            <div class="fs-5 mb-5">
                                <!-- <span style="color: #c7009d;">{{ product.sale_price }} դր․</span> -->
                                <item-price :product="product"></item-price>
                            </div>
                            <div>
                                <add-to-cart-btn-large :prop-product='product'></add-to-cart-btn-large>
                            </div>
                            <table >
                                <tr>
                                    <th scope="row">Կոդ</th>
                                    <td>{{ product.sku }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Տեսակ</th>
                                    <td>{{ product.categories[0].slug }}</td>
                                </tr>
                                <!-- <tr>
                                    <th scope="row">Սեզոն</th>
                                    <td>{{ product.categories[1].meta_title }}</td>
                                </tr> -->
                                <tr v-for="item in product.attribute_options">
                                    <th scope="row">{{ item.attribute.name }}</th>
                                    <td>{{ item.name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Հասցե</th>
                                    <td>Ք․Երևան Արտաշեսյան 39</td>
                                </tr>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div>
            <related-products :product="product"></related-products>
        </div>
    </div>
</template>


<script>
import { mapActions } from "vuex";
import UpsellProducts from "./UpsellProducts";

export default {
    components: { UpsellProducts },
    props: ['product', 'img', 'attachments'],
    data() {
        console.log(this.product)
        return {
            checkedSize: '',
        }
    },

    methods: {
        ...mapActions(["addToCart"]),
        addSize(size) {
            this.checkedSize = size;
            // console.log(this.checkedSize)
            // return  {size: this.size}
        }
    }
}
</script>

<style scoped>
.add-btn {
    padding: 0;
}

.info_div {
    width: 100%;
}

.info_ul {
    width: 50%;
}
table{
    width: 100%;
}
table tr td{
    display: flex;
    justify-content: flex-end;
    height: 45px;
    margin: 0;
    padding: 0;
    align-items: center;

}
table tr{
    border-bottom:solid 3px #c7009d;
}

</style>

