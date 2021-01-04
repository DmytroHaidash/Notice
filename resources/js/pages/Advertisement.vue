<template>
    <div class="content-col" v-if="advertisement">
        <div class="content-body">
            <img :src="advertisement.image" width="400">
            <h1 class="title" style="display: flex;">
                {{advertisement.title}}
                <add-to-favorite :advertisement="advertisement" v-if="$attrs.auth"></add-to-favorite>
            </h1>

            <p>{{advertisement.category.parent ? advertisement.category.parent.title +' -> ' : ''}}
                {{advertisement.category.title}}</p>
            <router-link :to="{path: `/profile/${advertisement.user.id}`}"
                         v-if="$attrs.auth" style="display: flex;">
                <img :src="advertisement.user.image" alt="" style="height: 50px;">
                <p style="margin-left: 10px">{{advertisement.user.name}}</p>
            </router-link>
            <div style="display: flex;" v-else>
                <img :src="advertisement.user.image" alt="" height="50">
                <p style="margin-left: 10px">{{advertisement.user.name}}</p>
            </div>


            <p>{{advertisement.created_at}}</p>

            <div v-html="advertisement.description"></div>

            <p>{{advertisement.phone}}</p>

            <p>{{advertisement.country}}</p>

            <p>{{advertisement.email}}</p>
            <div v-if="advertisement.weather">
                <h4>Погода</h4>
                <p>Сейчас: <img :src="advertisement.weather.current.icon" width="50" ></p>
                <p>Температура - {{advertisement.weather.current.temp}}</p>
                <p>Влажность - {{advertisement.weather.current.humidity}}</p>
                <p>Давление - {{advertisement.weather.current.pressure}}</p>
                <p>Состояние атмосферы - {{advertisement.weather.current.description}}</p>
                <table>
                    <thead class="w-50">
                    <tr>
                        <th scope="col">Дата</th>
                        <th scope="col">Днем</th>
                        <th scope="col">Ночью</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in advertisement.weather.daily">
                        <th>{{item.date}}</th>
                        <th>{{item.day}}</th>
                        <th>{{item.night}}</th>
                    </tr>
                    </tbody>
                </table>
            </div>

            <google-map v-if="advertisement.latitude && advertisement.longitude"></google-map>

            <comments style="margin-top: 50px"></comments>
        </div>

    </div>
</template>

<script>
  import GoogleMap from './../components/GMap';
  import Comments from './../components/comments/List';
  import AddToFavorite from './../components/AddToFavorite';

  export default {
    data() {
      return {
        advertisement: null,
      }
    },
    components: {
      GoogleMap,
      Comments,
      AddToFavorite,
    },
    created() {
      this.getData(this.$route.params.advertisement);
    },
    methods: {
      async getData(advertisement) {
        await axios
          .get(`/advertisements/${advertisement}`)
          .then(({data}) => {
            this.advertisement = data;
          })
      },
    },
  }
</script>
