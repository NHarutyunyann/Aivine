<template>
    <div>
        <div class="write-order">
            <h4>Գրել պատվեր</h4>
            <a target="_blank" href="/patver-grelu-nor-tarberak">(Ինչպես օգտվել)</a>
        </div>
        <div class="radio-btn-box">
            <label>
                <input type="radio" v-model="searchType" value="sku" checked />
                Ըստ ապրանքի կոդի
            </label>
            <label>
                <input type="radio" v-model="searchType" value="title" />
                Ըստ ապրանքի անվանման
            </label>
        </div>
        <table>
            <thead>
            <tr>
                <th>ապրանքի կոդ</th>
                <th>Քանակ</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(item, index) in items">
                <td>
                    <input v-model="item.sku" @paste="onPaste" type="text">
                </td>
                <td>
                    <input v-model="item.quantity" @paste="onPaste" type="number">
                </td>
                <td><i v-if="index !== 0" @click="items.splice(index, 1)" class="remove_tr fa fa-minus-circle"></i></td>
            </tr>
            </tbody>
        </table>
        <div class="row btn-box">
            <div class="col-12 col-md-6 text-center">
                <button @click="addItem">
                    <i class="fa fa-plus"></i>
                    Ավելացնել տող
                </button>
            </div>
            <div class="col-12 col-md-6 text-center">
                <button @click="handleAddToCart">
                    <i class="fa fa-cart-plus"></i>
                    Ավելացնել բոլորը զամբյուղ
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import {mapActions} from "vuex";

export default {
    data() {
      return {
          searchType: 'sku',
          items: [
              {sku: null, quantity: null},
              {sku: null, quantity: null},
          ]
      }
    },
    methods: {
        ...mapActions(['handleFastOrder']),
        onPaste($event) {
            let columns = $event.clipboardData.getData('text/plain')?.split(/\s+/).filter(i => i);
            if(columns.length <= 1) {
                return;
            }

            const [skuList, qtyList] = this.splitArray(columns)
            this.items = [];
            for(let i = 0; i < skuList.length; i++) {
                if(skuList[i] && qtyList[i]) {
                    this.items.push({sku: skuList[i], quantity: qtyList[i]})
                }
            }

            if(!this.items.length) {
                this.items = [{sku: null, quantity: null}];
            }
            setTimeout(function () {
                document.execCommand('undo', false, null);
            }, 200)
        },
        addItem() {
            this.items.push({sku: null, quantity: null})
        },
        handleAddToCart() {
            this.handleFastOrder({items: this.items, searchType: this.searchType})
        },
        splitArray(candid) {
            let oddOnes = [],
                evenOnes = [];
            for(let i = 0; i < candid.length; i++)
                (i % 2 === 0 ? evenOnes : oddOnes).push(candid[i]);
            return [evenOnes, oddOnes];
        }
    }
}
</script>
