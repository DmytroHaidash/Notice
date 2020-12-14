<template>
    <div v-if="$parent.$attrs.auth">
        <div style="margin-bottom: 30px" v-if="$parent.$attrs.auth.role === 'admin' && comments.length">
            <preloader v-if="loading"></preloader>
            <button class="btn btn-outline-primary"  @click.prevent="exportComments" v-else>Експорт комментариев</button>
        </div>

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
  import Preloader from './../Preloader';

  export default {
    name: "List",
    components: {
      Comment,
      CommentsForm,
      Preloader
    },
    data() {
      return {
        comments: [],
        url: `comments/${this.$route.params.advertisement}`,
        loadMore: true,
        loading: false,
      }
    },
    methods: {
      exportComments(){
        this.loading = true;
        axios.get(`/exports/comments/${this.$route.params.advertisement}`).then(
          window.Echo.channel(`comments`).listen('ExportComments', (e) => {
            let file_name = `export-comments-${this.$route.params.advertisement}.csv`;
            saveAs(e.data, file_name);
            this.loading = false;
            window.Echo.leave('advertisements');
          })
        )
      },
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
    }
  }
</script>

