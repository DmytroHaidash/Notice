<template>
    <div class="container">
        <h1>
            Google Map
        </h1>
        <gmap-map
                v-bind="options"
                id="map"
                :options="{disableDefaultUI:true}"
                @click="setPlace"
        >
            <gmap-marker
                    :position="options.center"
                    :clickable="false"
                    :draggable="false"
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
    props: {
      autocomplete: Boolean, default() {
        return false
      }
    },
    computed: {
      google: gmapApi
    },
    methods: {
      setPlace(place) {
        if (this.autocomplete) {
          this.options.center.lat = place.latLng.toJSON().lat;
          this.options.center.lng = place.latLng.toJSON().lng;
          this.$emit('map', {
            latitude: place.latLng.toJSON().lat,
            longitude: place.latLng.toJSON().lng
          })
        }
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
      }
      ;
      if (this.$route.params.user) {
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
