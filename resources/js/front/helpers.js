import Vuex from "vuex"
import store from "./store";

let vmInstance = null

const applyQueryParams = (obj) => {
    const url = new URL(document.location.href)
    const params = url.searchParams

    Object.keys(obj).map(key => {
        if(obj[key]) {
            params.set(key, obj[key])
        } else {
            params.delete(key)
        }

    })

    url.search = params.toString()
    const newUrl = url.toString()

    location.href = newUrl;
    // history.pushState({}, null, decodeURIComponent(newUrl))

    return newUrl
}

const renderProductList = async (obj, state) => {
    try{
        const {data} = await axios.get(applyQueryParams(obj))

        const container = document.getElementById('product-list-container')
        container.innerHTML = data
        if(vmInstance) {
            vmInstance.$destroy();
        }

        vmInstance = new window.Vue({
            el: container,
            store: new Vuex.Store({...store, ...{state}})
        });
    } catch (e) {
        console.log('ERROR: ', e)
    }
}

export default {
    applyQueryParams,
    renderProductList
}
