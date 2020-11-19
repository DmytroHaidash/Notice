<template>
    <div>
        <form @submit.prevent="store">
            <div class="form-group in-focus">
                <label>Оставьте свой комментарий</label>
                <div class="form-control">
                    <wysiwyg name="content" :content="content" style="width:80%;" @wysiwyg="getWysiwyg"></wysiwyg>
                </div>
            </div>
            <button class="btn btn-primary">
                Сохранить
            </button>
        </form>
    </div>

</template>

<script>
  import Wysiwyg from './../TinyMCE';

  export default {
    data() {
      return {
        content: ''
      }
    },
    props: {
      edit: Object || null
    },
    components: {
      Wysiwyg
    },

    methods: {
      getWysiwyg(data) {
        this.content = data;
      },
      store() {
        const formData = {
          content: this.content,
          advertisement_id: this.$route.params.advertisement,
        };
        if (this.edit) {
          axios.post(`comments/update/${this.edit.id}`, formData);
          this.$emit('update', this.content);
          this.content = '';
        } else {
          axios.post('comments/store', formData);
          this.content = '';
        }
        this.$emit('send');
      }
    },
    created() {
      if (this.edit) {
        this.content = this.edit.content;
      }
    }
  }
</script>

<style scoped>

</style>