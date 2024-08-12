import Vue from "vue"
import _ from 'lodash'
import services from "../services";
import constants from "../services/constants";

try {
    window.Popper = require('popper.js').default

    require('bootstrap')
} catch (e) {
    console.error(e);
}

window.axios = require('axios')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

window.Vue = Vue

const files = require.context('./components', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.mixin({
    methods: services,
    data: function () {
        return {
            constants: constants,
            _configs: _configs,
            moment: require('moment'),
        }
    }
})

Vue.prototype._configs = window._configs
Vue.prototype.$_ = _
const app = new Vue({
    el: '#admin',
});

/*
$('.nav-item.select').click(function () {
    $(this).toggleClass('active');
});
*/

$(document).ready(function(){

    let path = window.location.href;
    $('.nav-link').each(function() {
        if (this.href === path) {
            $(this).addClass('active');
            $(this).parents('.subMenu').addClass('active');
            $(this).parents('.nav-item').addClass('active');
        }
    });

    pageFixedHeader();

    function pageFixedHeader() {
        let elementPosition = $('.page-fixed-header').offset();
        if ( $('.page-fixed-header').length > 0) {
            $(window).scroll(function(){
                if($(window).scrollTop() > elementPosition.top){
                    $('.page-fixed-header').addClass('fixed');
                } else {
                    $('.page-fixed-header').removeClass('fixed');
                }
            });
        }
    };

});


