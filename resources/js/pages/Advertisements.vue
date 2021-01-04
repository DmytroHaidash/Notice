<template>
    <div class="content-col">
        <div class="content-body">
            <div style="margin-bottom: 20px; width: 80%" v-if="categories.length">
                <label for="category" style="margin-bottom: 20px">Фильтровать по категории:</label>
                <select name="category" id="category" style="margin-bottom: 20px; width: 100%"
                        v-model="selectedCategory" @change="getFilterAdvertisements">
                    <option :value="null" selected>Все</option>

                    <option v-for="category in categories" :value="category.id">{{category.title}}</option>
                </select>
            </div>
            <div style="margin-bottom: 20px" v-if="$attrs.auth && $attrs.auth.role === 'admin' && advertisements.length">
                <preloader v-if="loading"></preloader>
                <button class="btn btn-outline-primary" @click.prevent="exportAdvertisements" v-if="!loading">Експорт
                    объявлений
                </button>
                <button class="btn btn-outline-primary" @click.prevent="exportUsers" v-if="!loading">Експорт
                    пользователей
                </button>
            </div>

            <table style="width: 100%">
                <thead class="w-100">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"></th>
                    <th scope="col">Заголовок</th>
                    <th scope="col">Дата создания</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Автор</th>
                    <th scope="col">Погода</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody v-if="advertisements.length">
                <tr v-for="(item, index) in advertisements">
                    <th>{{item.id}}</th>
                    <th>
                        <img :src="item.image" width="50">
                    </th>
                    <th>
                        <router-link :to="{path: `/advertisement/${item.id}`, params: item.id}">
                            {{item.title}}
                        </router-link>
                    </th>
                    <th>{{item.created_at}}</th>
                    <th>{{item.trim_description}}</th>
                    <th>
                        <router-link :to="{path: `/profile/${item.user.id}`, params: item.user.id}" v-if="$attrs.auth">
                            {{item.user.name}}
                        </router-link>
                        <p v-else>{{item.user.name}}</p>
                    </th>
                    <th>
                        <img :src="item.weather.current.icon" width="50" v-if="item.weather">
                    </th>
                    <th>
                        <router-link :to="{path: `/advertisement/${item.id}`, params: item.id}">
                            Смотреть
                        </router-link>
                        <router-link v-if="$attrs.auth && $attrs.auth.id === item.user.id"
                                     :to="{path: `/advertisement/edit/${item.id}`, params: item.id}">
                            Редактировать
                        </router-link>
                        <a href="#" @click.prevent="deleteAdvertisement(item.id, index)"
                           v-if="$attrs.auth && ($attrs.auth.id === item.user.id || $attrs.auth.role === 'admin')">Удалить</a>
                    </th>
                </tr>
                </tbody>
                <tr v-else>
                    <td colspan="6">Объявления пока не созданы!</td>
                </tr>
                <tr v-if="!!url">
                    <td colspan="6">
                        <a href="#" class="btn btn-outline-primary ml-4 mt-4"
                           @click.prevent="getAllAdvertisements">
                            Еще
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    import Preloader from './../components/Preloader';
    import { saveAs } from 'file-saver';
  export default {
    data() {
      return {
        url: '/advertisements',
        advertisements: [],
        categories: [],
        selectedCategory: null,
        loading: false,
      }
    },
    components:{
      Preloader
    },
    created() {
      if (this.$route.params.category) {
        this.url = `/advertisements/category/${this.$route.params.category}`;
      }
      this.getCategories();
      this.getAllAdvertisements();
    },
    methods: {
      exportAdvertisements() {
        this.loading = true;
        axios.get('/exports/advertisements').then(
          window.Echo.channel(`advertisements`).listen('ExportAdvertisements', (e) => {
            saveAs(e.data, 'export-advertisements.csv');
            this.loading = false;
            window.Echo.leave('advertisements');
          })
        )
      },
      exportUsers(){
        this.loading = true;
        axios.get('/exports/users').then(
          window.Echo.channel(`users`).listen('ExportUsers', (e) => {
            saveAs(e.data, 'export-users.csv');
            this.loading = false;
            window.Echo.leave('users');
          })
        )
      },
      deleteAdvertisement(id, index) {
        axios.delete(`/advertisements/${id}`)
          .then(() => {
            this.advertisements.splice(index, 1);
          })
      },
      getFilterAdvertisements() {
        if (this.selectedCategory) {
          this.url = `/advertisements/category/${this.selectedCategory}`
        } else {
          this.url = '/advertisements'
        }
        this.advertisements = [];
        this.getAllAdvertisements();
      },
      getAllAdvertisements() {
        axios.get(this.url).then(({data}) => {
          this.advertisements.push(...data.items);
          this.url = data.next;
        })
      },
      getCategories() {
        axios.get('/categories/all').then(({data}) => {
          this.categories = data;
        })
      }
    },
  }
</script>
<style lang="scss" scoped>
    svg {
        fill: transparent;
        stroke: #2fa360;
        transition: .5s;

        &:hover {
            stroke: #fff;
        }
    }
</style>
