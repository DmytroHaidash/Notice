<template>
    <div>
        <comments-form></comments-form>
    </div>
</template>

<script>
  import CommentsForm from './Form';
  import Comment from './Item';

  export default {
    name: "List",
    components:{
      Comment,
      CommentsForm
    }
  }
</script>

