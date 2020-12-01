<template>
    <div class="content-col">
        <table class="content-body">
            <thead class="w-100">
            <tr>
                <th scope="col">#</th>
                <th scope="col"></th>
                <th scope="col">Заголовок</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Описание</th>
                <th scope="col">Автор</th>
                <th></th>
            </tr>
            </thead>
            <tbody v-if="favorites">
            <tr v-for="item in favorites">
                <th>{{item.advertisement.id}}</th>
                <th>
                    <img :src="item.advertisement.image" width="50">
                </th>
                <th>
                    <router-link :to="{path: `/advertisements/${item.advertisement.id}`, params: item.advertisement.id}">
                        {{item.advertisement.title}}
                    </router-link>
                </th>
                <th>{{item.advertisement.created_at}}</th>
                <th>{{item.advertisement.trim_description}}</th>
                <th>
                    <router-link :to="{path: `/profile/${item.advertisement.user.id}`, params: item.advertisement.user.id}">
                        {{item.advertisement.user.name}}
                    </router-link>
                </th>
                <th>
                    <router-link :to="{path: `/advertisements/${item.advertisement.id}`, params: item.advertisement.id}">
                        Смотреть
                    </router-link>
                </th>
            </tr>
            </tbody>
            <tr v-else>
                <td colspan="6">В Избранное пока еще ничего не добавленно!</td>
            </tr>


        </table>
    </div>
</template>

<script>
  export default {
    data(){
      return {
        favorites: null,
      }
    },
    methods:{
      getData(){
        axios.get('/favorite/items')
          .then(({data}) => {
            this.favorites = data;
          })
      },
    },
    created(){
      this.getData();
    }
  }
</script>

<style scoped>

</style>