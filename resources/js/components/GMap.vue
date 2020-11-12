<template>
    <div class="container">
        <h1>
            Google Map
        </h1>
        <div class="form-group in-focus">
            <label for="origin">Адресс</label>
            <div class="form-control">
                <gmap-autocomplete />
            </div>
        </div>
        <div class="search">

        </div>

        <gmap-map
                v-bind="options"
                id="map"
                :options="{disableDefaultUI:true}"
        >
        </gmap-map>
    </div>
</template>

<script>
  import { gmapApi } from 'vue2-google-maps';

  export default {
    name: "GoogleMap",
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
        origin:'',
        originSearchBox:'',
      };
    },
    computed: {
      google: gmapApi
    },
    // methods: {
    //   init: function() {
    //     this.originSearchBox = new this.google.places.SearchBox(this.$refs.origin);
    //     this.originSearchBox.addListener('places_changed', () => {
    //       this.origin = this.$refs.origin.value;
    //     });
    //   }
    // },
  };
</script>

<style lang="scss" scoped>
    #map {
        height: 500px;
        width: 100%;
        margin: 0 auto;
    }
</style>
