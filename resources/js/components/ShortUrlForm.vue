<template>
    <form @submit.prevent="submit()">

        <div class="form-group has-error">
            <label for="link"></label>
            <input v-model="link" type="text" name="link" id="link"
                   class="form-control"
                   :class="{'is-invalid': errors.link}"
                   placeholder="Type your link here" aria-describedby="helpId">
            <span class="form-text invalid-feedback" v-if="errors.link">{{ errors.link }}</span>
        </div>
        <button type="submit" class="btn btn-primary" :disabled="loading">Get my link
            <i v-if="loading" class="fa fa-spinner fa-spin" aria-hidden="true"></i>
        </button>

        <div v-if="shortLink">
            <br>
            <h2>Your short link:</h2>
            <h3 class="underline"><code><a :href="shortLink" target="_blank">{{ shortLink }}</a></code></h3>
            <button type="button" class="btn btn-success btn-xs" @click="copyToClipboard()">
                Copy
            </button>
        </div>

    </form>
</template>

<script>
    export default {
        name: "ShortUrlForm",
        data: function () {
            return {
                link: '',
                shortLink: null,
                loading: false,
                errors: {
                    link: null,
                },
            }
        },
        methods: {
            submit() {
                this.shortLink = null;
                this.loading = true;
                Object.keys(this.errors).map((i) => this.errors[i] = null)

                axios.post('/short-urls', {
                    link: this.link
                })
                    .then(response => {
                        this.shortLink = response.data.data.link;
                    })
                    .catch(errors => {
                        if (errors && errors.response) {
                            console.log(errors.response);
                            Object.keys(errors.response.data.errors).map((i) => {
                                if (errors.response.data.errors[i][0]) {
                                    this.errors[i] = errors.response.data.errors[i][0]
                                }
                            })
                        }
                    })
                    .finally(() => {
                        setTimeout(() => this.loading = false, 500)
                    })
            },
            copyToClipboard() {
                const el = document.createElement('textarea');
                el.value = this.shortLink;
                el.setAttribute('readonly', '');
                el.style.position = 'absolute';
                el.style.left = '-9999px';
                document.body.appendChild(el);
                el.select();
                document.execCommand('copy');
                document.body.removeChild(el);
            }
        }
    }
</script>

<style scoped>
    .underline {
        text-decoration: underline;
    }
</style>
