<template>
    <div class="row pt-5">
        <div class="container">
            <div class="row">
                <div v-if="partners.length" class="col-12 mr-3 ml-3 colleagues-title-box">
                    <h2>Մեր գործընկերները</h2>
                </div>
            </div>
        </div>
        <div v-if="partners.length" class="col-12">
            <div class="partners-slider owl-carousel owl-theme dots-bottom">
                <img v-for="partner in partners" loading="lazy" :src="partner?.main_image.urls.original" alt="" />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
      return {
          partners: [],
          carouselOptions: {
              loop: false,
              margin: 38,
              autoplay: true,
              dots: true,

              autoWidth:true,
              responsive: {
              }
          }
      }
    },
    beforeMount() {
        this.getPartners()
    },
    methods: {
        async getPartners() {
            const {data} = await axios.get(`/partners/get`)
            this.partners = (data && data.partners) || [];
            this.$nextTick(function () {
                console.log('this.carouselOptions: ', this.carouselOptions)
                $('.partners-slider').owlCarousel(this.carouselOptions)
            });
        }
    }
}
</script>
