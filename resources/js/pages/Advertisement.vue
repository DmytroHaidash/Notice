<template>
    <div class="content-col" v-if="advertisement">
        <div class="content-body">
            <img :src="advertisement.image" width="400">
            <h1 class="title">
                {{advertisement.title}}
            </h1>
            <p>{{advertisement.created_at}}</p>

            <div v-html="advertisement.description"></div>

            <p>{{advertisement.phone}}</p>

            <p>{{advertisement.country}}</p>

            <p>{{advertisement.email}}</p>

            <p>Add map</p>
        </div>

    </div>
</template>

<script>

  export default {
    data() {
      return {
        advertisement: [],
      }
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
