<template>
    <section class="notification-section">
        <div :class="`updated-notice ${note.type}`" v-for="note in $store.getters.notifications.items" v-if="(!target || target === $store.getters.notifications.target) && !note.flash">
            <div class="message-wrapper">
                <i v-if="note.type === 'success'" class="fa fa-check"></i>
                <i v-if="note.type === 'error'" class="fas fa-exclamation-circle"></i>
                <p v-html="note.message" class="note-message mb-0"></p>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: ['target'],
    computed: {
    }
}
</script>
<style>
.updated-notice {
    margin: 10px 0 20px;
    min-height: 50px;
    padding: 16px;
    display: flex;
    align-items: center;
    border-radius: 6px;
}

.updated-notice .note-message {
    display: flex;
    width: auto;
    font-size: 16px!important;
    font-family: "Mardoto-Medium"!important;
    letter-spacing: 0.2px;
    font-weight: normal;
}

@media screen and (max-width: 768px) {
    .updated-notice .note-message {
        flex-wrap: wrap;
    }
    .updated-notice .note-message .link {
        width: 100%;
        margin-top: 12px;
        margin-left: 0;
    }
}

.updated-notice  .message-wrapper {
    font-family: Roboto, Arial, Helvetica, sans-serif;
    color: rgb(255 255 255);
    font-size: 16px;
    margin: 0;
    display: flex;
    width: 100%;
}
.updated-notice  .message-wrapper i {
    margin-right: 16px;
    position: relative;
    top: 0.1em;
}
.updated-notice  .message-wrapper p {
    line-height: 1.1;
    width: 100%;
    margin-bottom: 0 !important;
}
.updated-notice  .message-wrapper a{
    margin-left: 6px;
}
.updated-notice.error {
    background-color: #ff0000;
}
.updated-notice.error a {
    color: white!important;
    text-decoration:underline;
}
.updated-notice.error a:hover {
    color: #cccaca !important;
    text-decoration:underline;
}
.updated-notice.success {
    background-color: #7A9C59;
}
</style>
