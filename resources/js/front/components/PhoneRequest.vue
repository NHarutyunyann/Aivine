<template>
    <form onsubmit="return false;" class="call-request-form">
        <div class="call-request-form--inner">
            <div class="img-box">
                <picture class="image">
                    <source srcset="/images/call-popup/desktop/worker-illustration3x.png" media="(min-width: 1023px)">
                    <source srcset="/images/call-popup/tablet/worker-illustration-tablet3x.png" media="(min-width: 767px)">
                    <source srcset="/images/call-popup/mobile/worker-illustration-mobile3x.png" media="(max-width: 768px)">
                    <img loading="lazy" src="/images/call-popup/desktop/worker-illustration3x.png" alt="worker-illustration">
                </picture>
            </div>
            <div class="form-box">
                <div class="title-box">
                    <h4 class="form-title">Պատվիրեք զանգ</h4>
                    <p class="form-subtitle">Լրացրեք Ձեր տվյալները և մեր մասնագետը կապ կհաստատի ձեր հետ</p>
                </div>
                <div v-if="!requestSuccess">
                   <div class="form-group" :class="{'form-group-error': error, 'form-group-success': isValid}">
                       <label class="form-label">Հեռախոսահամար <span class="star">*</span></label>
                       <div class="input-group position-relative">
                           <input maxlength="9" @input="phone = validatePhone($event);" v-model="phone" class="form-input" placeholder="77123756" type="text">
                           <img src="/images/call-popup/check.svg" class="input-img input-img-check" alt="check">
                           <img src="/images/call-popup/flag-arm.svg" class="input-img input-img-flag" alt="flag">
                           <span class="input-label-num">+374</span>
                       </div>
                       <span v-if="error" class="error-text">{{ error }}</span>
                   </div>
                   <button @click="onSendPhoneRequest" class="btn-submit">Ուղարկել</button>
                </div>
                <div v-if="requestSuccess">
                    <div class="send-again">
                        <img src="/images/call-popup/check.svg" class="img-check" alt="check">
                        <p class="info">Շնորհակալություն, Ձեր զանգը պատվիրված է: Մեր մասնագետը շուտով կապ կհաստատի Ձեր հետ</p>
                    </div>
                    <button class="btn-submit" @click="onSendAgain">Պատվիրել կրկին</button>
                </div>
            </div>
        </div>
        <span class="close-btn" @click="closeModal">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.26343 18.7384L10.0018 10.0001L18.7401 18.7384M18.7401 1.26172L10.0001 10.0001L1.26343 1.26172" stroke="#CCCCCC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </span>
    </form>
</template>
<script>
import {mapActions} from "vuex";
import Notifications from "./Notifications";

export default {
    components: {Notifications},
    data() {
        return {
            phone: null,
            error: null,
            isValid: false,
            requestSuccess: false,
        }
    },
    methods: {
        ...mapActions(['sendPhoneRequest']),
        onSendPhoneRequest() {
            this.error = null;
            if(!this.phone) {
                this.error = 'Հեռախոսահամարի դաշտը պարտադիր է';
                return;
            }

            if(this.phone.length !== 9) {
                this.error = 'Հեռախոսահամարի դաշտը պետք է պարունակի 9 թիվ';
                return;
            }

            this.sendPhoneRequest({phone: this.phone}).then(([error, data]) => {
                if(!error) {
                  this.requestSuccess = true;
                }
            });
        },
        closeModal() {
            $('#phoneRequest').modal('hide');
        },
        validatePhone(event) {
            const value = event.target.value.replace(/\D/g,'');
            this.isValid = false;
            if(value.length === 9) {
                this.isValid = true;
                this.error = null;
            }
            return value
        },
        onSendAgain() {
            this.requestSuccess = false;
            this.isValid = false;
            this.error = null;
            this.phone = null;
        }
    }
}
</script>
