<template>
    <div>
        <navbar :user="user"/>
        <router-view class=" py-4"/>
    </div>
</template>

<script>
    import Navbar from "./components/Navbar";
    export default {
        name: 'App',
        components: {Navbar},
        data() {
            return {
                user: null,
            }
        },
        mounted() {
        },
        created() {
            this.getUser();
        },
        methods: {
            getUser() {
                axios.get('/user')
                    .then(res => {
                        this.user = res.data.data.user;
                    })
            }
        }
    }
</script>

<style>
    [v-cloak] {
        display: none;
    }
</style>
