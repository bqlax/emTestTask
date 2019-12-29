<template>
    <form class="row" @submit.prevent="submit">
        <div v-if="error" class="col-lg-12">
            <div class="alert-danger alert">
                <strong>Ошибка!</strong>
                <div v-for="(value, name) in error">
                    {{ name }}: {{ value }}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <div class="form-group">
                    <label>Заголовок новости</label>
                    <input v-model="title" name="title" type="text" class="form-control" placeholder="Заголовок" required>
                </div>
                <label>Slug</label>
                <input v-model="slug" name="slug" type="text" class="form-control" readonly>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Превью</label>
                <textarea v-model="text_short" name="preview" class="form-control" rows="3" placeholder="Начните ввод..."></textarea>
            </div>
            <div class="form-group">
                <label>Текст новости</label>
                <textarea v-model="text" name="text" class="form-control" rows="3" placeholder="Начните ввод..." required></textarea>
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
                error: null
            }
        },
        methods: {
            submit () {
                const config = false;
                const formData = new FormData();
                formData.append('title', this.title);
                formData.append('text', this.text);
                formData.append('text_short', this.text_short);
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
                        }
                    })
                    .catch((error) => {
                        if (error.response.data.errors) {
                            this.error = error.response.data.errors;
                        }
                    })
            }
        }
    }
</script>