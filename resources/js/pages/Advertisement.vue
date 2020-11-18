<template>
    <div class="content-col" v-if="advertisement">
        <div class="content-body">
            <img :src="advertisement.image" width="400">
            <h1 class="title">
                {{advertisement.title}}
            </h1>
            <router-link :to="{path: `/profile/${advertisement.user.id}`, params: advertisement.user.id}"
                         v-if="$attrs.auth" style="display: flex;">
                <img :src="advertisement.user.image" alt="" style="height: 50px;">
                <p style="margin-left: 10px">{{advertisement.user.name}}</p>
            </router-link>
            <div style="display: flex;" v-else>
                <img :src="advertisement.user.image" alt="" style="height: 50px;">
                <p style="margin-left: 10px">{{advertisement.user.name}}</p>
            </div>


            <p>{{advertisement.created_at}}</p>

            <div v-html="advertisement.description"></div>

            <p>{{advertisement.phone}}</p>

            <p>{{advertisement.country}}</p>

            <p>{{advertisement.email}}</p>

            <google-map v-if="advertisement.latitude && advertisement.longitude"></google-map>
        </div>

    </div>
</template>

<script>
  import GoogleMap from './../components/GMap';

  export default {
    data() {
      return {
        advertisement: [],
      }
    },
    components: {
      GoogleMap
    },
    created() {
      this.getData(this.$route.params.advertisement);
    },
    methods: {
      getData(advertisement) {
        axios
          .get(`/advertisements/${advertisement}`)
          .then(({data}) => {
            this.advertisement = data;
          })
      },
    },
  }
</script>
