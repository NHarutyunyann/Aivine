<template>
    <main class="main qartez-page">
        <div class="page-title-box">
            <h1>TOTAL մասնաճյուղերի քարտեզ</h1>
        </div>
        <div class="container qartez-container">
            <div class="map-filter-box">
                <button class="map-filter-button" @click="filteredState = null;filteredBuildings($event, true)">Բոլորը</button>
                <button v-for="state in states" @click="filteredState = state.value" class="map-filter-button" :class="{active: filteredState === state.value}">{{ state.option }}</button>
            </div>
            <div v-if="filteredState" class="checkBoxArea">
                <div class="CBoxContainer">
                    <div class="row">
                        <div class="col-12">
                            <p class="areaTitle">Ֆիլտր</p>
                        </div>
                    </div>
                    <div class="selects-content">
                        <div class="select-box" v-for="community in Object.keys(selectedStateCommunities)">
                            <h3>{{ community }}</h3>
                            <ul>
                                <li v-for="building in selectedStateCommunities[community]">
                                    <input class="selected-buildings" :data-building="building" type="checkbox" checked />
                                    <span>{{ building }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul></ul>
                        </div>
                        <div class="col-12 mapFilterActions">
                            <button type="button" @click="emptyCheckboxes" class="btn btn-default clearFilter">Մաքրել</button>
                            <button type="button" @click="filteredBuildings" class="btn btn-primary applyFilter">Կիրառել</button>
                        </div>
                    </div>
                </div>
            </div>


            <div id="map" class="location-img-popup"></div>
            <div id="location-popup" class="card-popup white-popup mfp-with-anim mfp-hide">
                <img class="location-img" src="" />
            </div>
        </div><!-- End .container -->
    </main><!-- End .main -->
</template>
<script>
export default {
    props: ['states'],
    mounted() {
        this.initMap().then(() => {
            ymaps.option.presetStorage .add('total#marker', {iconImageHref:'/images/marker.png', iconImageSize: [50, 53], iconLayout: 'default#image'});
            this.getBranches()
        });

        $(`.location-img-popup`).magnificPopup({
            delegate: `a.location-img-popup-link`,
            removalDelay: 500,
            callbacks: {
                beforeOpen: function() {
                    this.st.mainClass = this.st.el.attr('data-effect');

                    $('body #location-popup img.location-img').attr('src', $(this.items?.[0])?.find('img').attr('src'))
                }
            },
            midClick: true
        });
    },
    data() {
      return {
          yandexMap: null,
          branches: [],
          yMapSettings: {
              center: [40.181936, 44.514317],
              lang: 'hy-AM',
              region: 'AM',
              zoom: 10,
              controls: []
          },
          filteredState: null,
          markers: []
      }
    },
    computed: {
        selectedStateCommunities() {
            const communities = {};

            if(!this.filteredState) {
                return {}
            }

            for(let i = 0; i < this.branches.length; i++) {
                if(this.filteredState !== this.branches[i].state) {
                    continue;
                }

                if(!communities[this.branches[i].community]) {
                    communities[this.branches[i].community] = []
                }

                communities[this.branches[i].community].push(this.branches[i].building);
            }

            return communities;
        }
    },
    methods: {
        initMap() {
            return new Promise((resolve) => {
                ymaps.ready(() => {
                    if(!this.yandexMap) {
                        this.yandexMap = new ymaps.Map("map", this.yMapSettings)
                        return resolve(true);
                    }
                });
            })
        },
        setMarker(coordinates, data = {}) {
            const objectManager = new ymaps.ObjectManager({
                clusterize: true,
                clusterDisableClickZoom: true,
            });

            objectManager.objects.options.set({
                preset: 'total#marker',
            });

            objectManager.add({
                "type": "FeatureCollection",
                "features": [
                    {"type": "Point",
                        "id": data.id,
                        "geometry": {
                            "type": "Point",
                            "coordinates": coordinates},
                        "properties": {
                        "balloonContent":
                                '<div id="content">' +
                                '<div id="siteNotice" class="map-marker-content">' +
                                '<a href="#location-popup" class=\"location-img-popup-link\"><img style="height: 150px;" loading="lazy" src="' + ' ' + (data.logo_image ? data.logo_image.urls.medium : '') + ' ' + '"></a>' +
                                '</div>'+
                                '<div class="marker-popup-text-box"><h5 id="firstHeading" class="firstHeading">' + ' '  + (data['street'] || '') + ' ' + (data['building'] || '') + ' ' + '</h5>' +
                                '<p class="text"><img loading="lazy" src="/images/location-fill.svg" class="icon">' + ' ' + (data['street'] || '') + ' ' + (data['city'] || '') + ' ' + '</p>' +
                                '<p class="text"><img loading="lazy" src="/images/phone-fill.svg" class="icon">' + ' ' + (data['phone'] || '') + '</p>' +
                                '<span>' + ' ' + (data['working_hours'] || '') + ' ' + '</span><div></div>',

                        }
                    },
                ]
            })

            this.yandexMap.geoObjects.add(objectManager);

            return objectManager;
        },
        async getBranches() {
            const { data } = await axios.get('/branches/list')
            this.branches = data?.branches || [];

            for(let i = 0; i < this.branches.length; i++) {
                const branch = this.branches[i];
                this.markers.push(this.setMarker([branch.latitude, branch.longitude], branch))
            }
        },
        filteredBuildings($event, renderAll = false) {
            const selectedBuildings = Array.from(document.querySelectorAll('.selected-buildings:checked')).map(el => el.getAttribute('data-building'));
            console.log('selectedBuildings ', selectedBuildings)
            for(let i = 0; i < this.markers.length; i++) {
                this.yandexMap.geoObjects.remove(this.markers[i]);
                delete this.markers[i];
            }

            for(let i = 0; i < this.branches.length; i++) {
                const branch = this.branches[i];
                if(renderAll || selectedBuildings.includes(branch.building)) {
                    this.markers.push(this.setMarker([branch.latitude, branch.longitude], branch))
                }
            }
        },
        emptyCheckboxes() {
            Array.from(document.querySelectorAll('.selected-buildings:checked')).forEach(el => el.checked = false);
        }
    }
}
</script>
