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
                <th></th>
            </tr>
            </thead>
            <tbody v-if="advertisements.length">
            <tr v-for="item in advertisements">
                <th>{{item.id}}</th>
                <th>
                    <img :src="item.image" width="50">
                </th>
                <th>
                    <router-link :to="{path: `/advertisements/${item.id}`, params: item.id}">
                        {{item.title}}
                    </router-link>
                </th>
                <th>{{item.created_at}}</th>
                <th>{{item.trim_description}}</th>
                <th>
                    <router-link :to="{path: `/advertisements/${item.id}`, params: item.id}">
                        Смотреть
                    </router-link>
                    <router-link v-if="$attrs.auth && $attrs.auth.id === item.user.id" :to="{path: `/advertisements/edit/${item.id}`, params: item.id}">
                        Редактировать
                    </router-link>
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
</template>

<script>

  export default {
    data() {
      return {
        url: '/advertisements',
        advertisements: [],
      }
    },
    created() {
      this.getAllAdvertisements();
    },
    methods: {
      getAllAdvertisements() {
        axios.get(this.url).then(({data}) => {
          this.advertisements.push(...data.items);
          this.url = data.next;
        })
      },
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
