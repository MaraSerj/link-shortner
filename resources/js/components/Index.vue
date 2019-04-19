<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Make your url shortner</div>

                    <div class="card-body">
                        <short-url-form/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ShortUrlForm from "./ShortUrlForm";
    export default {
        components: {ShortUrlForm},
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
