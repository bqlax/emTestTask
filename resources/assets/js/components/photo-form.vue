<template>
    <form class="col-lg-6 col-lg-offset-3" @submit.prevent="submit">
        <div class="form-group">
            <label>Заголовок фото</label>
            <input v-model="name" name="name" type="text" class="form-control" placeholder="Заголовок фото" required>
        </div>
        <div class="form-group">
            <label>Slug</label>
            <input v-model="slug" name="slug" type="text" class="form-control" readonly>
        </div>
        <img v-if="path" class="category-img" :src="path" alt="image">
        <img v-else :src="nophoto">
        <input type="submit" class="btn-lg btn-block btn btn-default" value="Сохранить">
    </form>
</template>

<script>
    export default {
        props: {
            photo: Object,
            nophoto: String,
            method: String,
            action: String
        },
        data () {
            return {
                name: (this.photo.title) ? this.photo.title : '',
                slug: (this.photo.slug) ? this.photo.slug : 'Автоматическая генерация',
                path: (this.photo.path) ? this.photo.path : null,
                modified_by: (this.photo.modified_by) ? this.photo.modified_by : null,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                error: null,
                errorSlug: 'Slug не уникальный! (Slug транслируется из заголовка, значит такой заголовок уже есть)'
            }
        },
        mounted(){
            console.log(this);
        },
        methods: {
            submit () {
                /*const config = false;
                const formData = new FormData();
                formData.append('title', this.title);
                formData.append('text', this.title);
                formData.append('text_short', this.title);
                formData.append('slug', this.slug);
                formData.append('_token', this.csrf);
                if (this.method == 'put') {
                    formData.append('_method', 'put');
                }
                if (this.modified_by) {
                    formData.append('modified_by', this.modified_by);
                }
                axios.post(this.action, formData, config)
                    .then((response) => {
                        if (response.data.action) {
                            document.location = response.data.action;
                        };
                    })
                    .catch((error) => {
                        if (error.response.data.errors.slug) {
                            this.error = this.errorSlug;
                        }
                    })*/
            }
        }
    }
</script>