<template>
    <div>
        <div style="display: flex;">
            <img :src="comment.user.image" alt="" style="height: 50px;">
            <p style="margin-left: 10px">{{comment.user.name}}</p>
            <p>Опубликовано: {{comment.created_at}}</p>
            <button class="btn btn-primary" v-if="!edit && makeEdit" @click="edit = true">Редактировать</button>
        </div>
        <comments-form :edit="comment" v-if="edit" @update="update"></comments-form>
        <div v-html="comment.content" v-else></div>
    </div>
</template>

<script>
  import CommentsForm from './Form';

  export default {
    props: {
      comment: Object
    },
    data() {
      return {
        edit: false,
      }
    },
    components: {
      CommentsForm
    },
    methods: {
      update(data) {
        this.comment.content = data;
        this.edit = false;
      }
    },
    computed: {
      makeEdit() {
        let now = new Date();
        let updated = new Date(this.comment.updated_at);
        updated.setMinutes(updated.getMinutes() + 10);
        if (this.comment.user.id === this.$attrs.auth.id && updated <= now) {
          return true
        }
        return false;
      },
    },
  }
</script>

<style scoped>

</style>