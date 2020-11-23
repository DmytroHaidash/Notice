<template>
    <div>
        <div style="display: flex;">
            <img :src="item.user.image" alt="" style="height: 50px;">
            <p style="margin-left: 10px">{{item.user.name}}</p>
            <p>Опубликовано: {{item.created_at}}</p>
            <button class="btn btn-primary" v-if="!edit && makeEdit" @click="edit = true">Редактировать</button>
        </div>
        <comments-form :edit="item" v-if="edit" @send="updateComment" style="margin-bottom: 50px; margin-top: 50px"></comments-form>
        <div v-html="item.content" v-else></div>
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
        item: null,
        edit: false,
      }
    },
    components: {
      CommentsForm
    },
    methods: {
      updateComment(data) {
        this.item.content = data.content;
        this.edit = false;
      },
      makeEdit: function() {
        let now = new Date();
        let updated = new Date(this.comment.updated_at);
        updated.setMinutes(updated.getMinutes() + 10);
        console.log(this.comment.user.id === this.$attrs.auth.id);
        return this.comment.user.id === this.$attrs.auth.id && updated <= now;
      },
    },
    created() {
      this.item = this.comment;
    }
  }
</script>

<style scoped>

</style>