<template>
    <div v-if="$parent.$attrs.auth">
        <comments-form @store="newComment" style="margin-bottom: 50px"></comments-form>
        <scroll-loader :loader-method="getData" :loader-enable="loadMore" style="display: block">
            <comment v-if="comments.length" v-for="(comment, index) in comments" :comment="comment"
                     :key="index"></comment>
        </scroll-loader>

    </div>

    <div v-else style="margin-bottom: 50px">
        <p><a href="/register">зарегистрироваться</a> / <a href="/login">авторизоваться</a> для просмотра комментариев.
        </p>
    </div>
</template>

<script>
  import CommentsForm from './Form';
  import Comment from './Item';

  export default {
    name: "List",
    components: {
      Comment,
      CommentsForm
    },
    data() {
      return {
        comments: [],
        url: 'comments/items',
        loadMore: true
      }
    },
    methods: {
      getData() {
        if (this.url) {
          axios.get(this.url)
            .then(({data}) => {
              this.comments.push(...data.items);
              this.url = data.next;
            });
          if(!this.url){
            this.loadMore = false
          }
        }

      },
      newComment(item) {
        this.comments.unshift(item);
      }
    },
    created() {
      this.getData();
    }
  }
</script>

