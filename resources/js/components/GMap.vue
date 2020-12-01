<template>
    <div class="container">
        <h1>
            Google Map
        </h1>
        <div class="form-group in-focus" v-if="autocomplete">
            <label>Адресс</label>
            <div class="form-control">
                <gmap-autocomplete @place_changed="setPlace"/>
            </div>
        </div>
        <div class="search">

        </div>

        <gmap-map
                v-bind="options"
                id="map"
                :options="{disableDefaultUI:true}"
        >
            <gmap-marker
                    :key="index"
                    :position="center = options.center"
                    :clickable="true"
                    :draggable="true"
                    @click="center=options.center"
            ></gmap-marker>
        </gmap-map>
    </div>
</template>

<script>
  import {gmapApi} from 'vue2-google-maps';

  export default {
    data() {
      return {
        options: {
          zoom: 10,
          center: {
            lat: 39.9995601,
            lng: -75.1395161
          },
          mapTypeId: 'roadmap',
        },
      };
    },
    props:{
      autocomplete: Boolean, default(){return false}
    },
    computed: {
      google: gmapApi
    },
    methods: {
      setPlace(place) {
        this.options.center.lat = place.geometry.viewport.Ya.i;
        this.options.center.lng = place.geometry.viewport.Sa.i;
        this.$emit('map', {
          latitude: place.geometry.viewport.Ya.i,
          longitude: place.geometry.viewport.Sa.i
        })
      }
    },
    created() {
      if (this.$route.params.advertisement) {
        axios
          .get(`/advertisements/${this.$route.params.advertisement}`)
          .then(({data}) => {
            if (data.latitude) {
              this.options.center.lat = data.latitude;
            }
            if (data.longitude) {
              this.options.center.lng = data.longitude;
            }
          })
      };
      if(this.$route.params.user) {
        axios
          .get(`/users/${this.$route.params.user}`)
          .then(({data}) => {
            if (data.latitude) {
              this.options.center.lat = data.latitude;
            }
            if (data.longitude) {
              this.options.center.lng = data.longitude;
            }
          })
      }
    }
  };
</script>

<style lang="scss" scoped>
    #map {
        height: 500px;
        width: 100%;
        margin: 0 auto;
    }
</style>
