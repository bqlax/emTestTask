<template>
    <form class="col-lg-6 col-lg-offset-3" @submit.prevent="submit">
        <div v-if="error" class="col-lg-5">
            <div class="alert-danger alert">
                <strong>Ошибка!</strong> {{ error }}
            </div>
        </div>
        <div class="form-group">
            <label>Заголовок новости</label>
            <input v-model="title" name="title" type="text" class="form-control" placeholder="Заголовок" required>
        </div>
        <div class="form-group">
            <label>Превью</label>
            <textarea v-model="text_short" name="preview" class="form-control" rows="3" placeholder="Начните ввод..."></textarea>
        </div>
        <div class="form-group">
            <label>Текст новости</label>
            <textarea v-model="text" name="text" class="form-control" rows="3" placeholder="Начните ввод..."></textarea>
        </div>
        <div class="form-group">
            <label>Slug</label>
            <input v-model="slug" name="slug" type="text" class="form-control" readonly>
        </div>
        <input type="submit" class="btn-lg btn-block btn btn-default" value="Сохранить">
    </form>
</template>

<script>
    export default {
        props: {
            news: Object,
            method: String,
            action: String
        },
        data () {
            return {
                title: (this.news.title) ? this.news.title : '',
                text_short: (this.news.text_short) ? this.news.text_short : '',
                text: (this.news.text) ? this.news.text : '',
                slug: (this.news.slug) ? this.news.slug : 'Автоматическая генерация',
                modified_by: (this.news.modified_by) ? this.news.modified_by : null,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                error: null,
                errorSlug: 'Slug не уникальный! (Slug транслируется из заголовка, значит такой заголовок уже есть)'
            }
        },
        methods: {
            submit () {
                const config = false;
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
                    })
            }
        }
    }
</script>