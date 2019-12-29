<template>
    <form class="row" @submit.prevent="submit">
        <div v-if="error" class="col-lg-12">
            <div class="alert-danger alert">
                <strong>Ошибка!</strong> {{ error }}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Заголовок фото</label>
                <input v-model="name" name="name" type="text" class="form-control" placeholder="Заголовок фото" required>
            </div>
            <div class="form-group">
                <label>Slug</label>
                <input v-model="slug" name="slug" type="text" class="form-control" readonly>
            </div>
        </div>
        <div class="col-lg-6">
            <div @click="browseServer" class="form-img form-img_width form-img_hover">
                <img v-if="path" :src="path" alt="image" class="form-img__item form-img_width">
                <img v-else :src="nophoto" class="form-img__item form-img_width">
            </div>
        </div>
        <div class="col-lg-12">
            <input type="submit" class="btn-lg btn-block btn btn-default" value="Сохранить">
        </div>
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
                name: (this.photo.name) ? this.photo.name : '',
                slug: (this.photo.slug) ? this.photo.slug : 'Автоматическая генерация',
                path: (this.photo.path) ? '/' + this.photo.path : null,
                modified_by: (this.photo.modified_by) ? this.photo.modified_by : null,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                error: null,
                errorSlug: 'Slug не уникальный! (Slug транслируется из заголовка, значит такой заголовок уже есть)'
            }
        },
        beforeCreate: function () {
            window.SetUrl = function(url) {
                this.path = url;
                this.attachment = this.getLocation(url).pathname.substr(1);
            }.bind(this);
        },
        methods: {
            submit () {
                const config = false;
                const formData = new FormData();
                console.log(this);
                if (this.path && this.name) {
                    formData.append('name', this.name);
                    formData.append('slug', this.slug);
                    formData.append('_token', this.csrf);
                    if (this.attachment) {
                        formData.append('path', this.attachment);
                    }
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
                            }
                        })
                        .catch((error) => {
                            if (error.response.data.errors.slug !== 'undefined') {
                                this.error = 'Slug не уникальный! (Slug транслируется из заголовка, значит такой заголовок уже есть)';
                            }
                        })
                } else {
                    this.error = 'Нет фото или имени фото!';
                }
            },
            getLocation(href) {
                var l = document.createElement("a");
                l.href = href;
                return l;
            },
            browseServer(obj) {
                this.urlobj = obj;
                window.open('/laravel-filemanager?type=Images', "BrowseWindow");
            },
        }
    }
</script>