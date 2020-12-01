<template>
    <div>
        <div style="display: flex;">
            <img :src="item.user.image" alt="" style="height: 50px;">
            <p style="margin-left: 10px">{{item.user.name}}</p>
            <p>Опубликовано: {{item.created_at}}</p>
            <button class="btn btn-primary" v-if="!edit && makeEdit && author" @click="edit = true">Редактировать</button>
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
        now: Date.now(),
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
      parseDate() {
        let updated = new Date(this.item.updated_at);
        updated.setMinutes(updated.getMinutes() + 10);
        return updated;
      },
      author(){
        return this.item.user.id === this.$parent.$parent.$parent.$attrs.auth.id
      }
    },
    computed:{
        makeEdit(){
          return Date.now() <= this.parseDate();
        }
    },
    created() {
      this.item = this.comment;
    }
  }
</script>

<style scoped>

</style>