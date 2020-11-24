<template>
    <div class="content-col">
        <table class="content-body">
            <thead class="w-100">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Заголовок</th>
                <th scope="col">Родительская категория</th>
                <th scope="col">Колличество обьявлений</th>
            </tr>
            </thead>
            <tbody v-if="categories.length">
                <tr v-for="item in categories">
                    <th>{{item.id}}</th>
                    <th>{{item.title}}</th>
                    <th>
                        <p v-if="item.parent">{{item.parent.title}}</p>
                        <p v-else>------------</p>
                    </th>
                    <th>{{item.count_ads}}</th>
                </tr>
            </tbody>
            <tr v-else>
                <td colspan="3">Категории пока не созданы!</td>
            </tr>
        </table>
    </div>
</template>

<script>
  export default {
    data(){
      return {
        categories: [],
      }
    },
    methods:{
        getData(){
          axios.get('/categories/all').then(({data}) => {
            this.categories = data;
          })
        }
    },
    created() {
      if(!this.$attrs.auth){
        this.$router.push('/');
      }
      this.getData();
    }
  }
</script>

<style scoped>

</style>