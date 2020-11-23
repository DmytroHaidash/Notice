<template>
    <div>
        <editor api-key="1xsyih2o8cngj6zqgzcady1utjw4u3fezk14xjr0hnd6iqgh" :init="options" v-model="output"
                @input="change"></editor>
        <input type="hidden" :name="name" :value="output">
    </div>
</template>

<script>
  import Editor from '@tinymce/tinymce-vue';

  export default {
    props: {
      name: String,
      content: String
    },
    components: {
      Editor
    },
    data() {
      return {
        output: this.content || '',
        options: {
          language: 'ru',
          language_url: '/js/langs/ru.js',
          plugins: "textpattern visualblocks table lists link",
          toolbar: "formatselect | alignleft aligncenter alignright | bold italic | link unlink | numlist bullist | forecolor backcolor | table",
        }
      }
    },
    methods: {
      change() {
        this.$emit('wysiwyg', this.output);
      },
      setValue(){
        this.output = '';
      }
    },
    created() {
      this.$parent.$on(('store' || 'send'), this.setValue);
    }
  }
</script>

<style>
    .tox.tox-tinymce {
        height: 450px !important;
    }
</style>