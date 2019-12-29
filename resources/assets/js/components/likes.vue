<template>
    <div class="likes">
        <a href="" :class="[{
            likes_active: is_likeLocal
        }]" @click.prevent="like">
            <span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
        </a>
        <span v-if="likesLocal > 0">({{ likesLocal }})</span>
    </div>
</template>

<script>
    export default {
        props: {
            route: String,
            id: Number,
            type: String,
            likes: Number,
            is_like: Boolean
        },
        data () {
            return {
                likesLocal: this.likes, //count of likes
                is_likeLocal: this.is_like, //like checker
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        methods: {
            like () {
                this.is_likeLocal = !this.is_likeLocal;
                const config = false;
                const formData = new FormData();
                formData.append(this.type + '_id', this.id);
                formData.append('_token', this.csrf);
                axios.post(this.route, formData, config)
                    .then((response) => {
                        if (response.data.likes !== 'undefined') {
                            this.likesLocal = response.data.likes;
                        };
                    })
                    .catch((error) => {
                        if (error.response.data.errors.slug) {
                            this.error = this.errorSlug;
                        }
                    })
            }
        }
    }
</script>