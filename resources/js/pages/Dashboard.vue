<template>
    <div>
        Welcome {{ nama }}
    </div>
</template>

<script>
export default {
    nama: "Dashboard",
    data() {
        return {
            nama: null,
        }
    },
    created() {
        if (window.Laravel.user) {
            this.name = window.Laravel.guest.nama
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>
