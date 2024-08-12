<template>
    <div class="modal-content">
        <div class="modal-body">
            <h5 class="modal-title" id="logoutAcceptLabel">Ցանկանու՞մ եք դուրս գալ կայքից</h5>
        </div>
        <div class="modal-footer">
            <a @click="onLogoutHandle" href="javascript:" class="btn btn-outline">Այո</a>
            <a href="" type="button" class="btn btn-primary" data-dismiss="modal">Ոչ</a>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        onLogoutHandle() {
            this.$store.commit('STORE_CART_HASH', null);
            this.$store.commit('LOAD_CART', []);
            location.href = '/logout';
        }
    }
}
</script>
