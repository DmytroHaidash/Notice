<template>
    <div class="content-col">
        <div class="content-body">
            <form @submit.prevent="store">
                <div class="form-group in-focus">
                    <label for="first_name">Имя</label>
                    <div class="form-control">
                        <input type="text" id="first_name" v-model="user.firstName" required>
                    </div>
                </div>
                <div class="form-group in-focus">
                    <label for="last_name">Фамилия</label>
                    <div class="form-control">
                        <input type="text" id="last_name" v-model="user.lastName" required>
                    </div>
                </div>
                <div class="form-group in-focus">
                    <label for="about">О себе</label>
                    <div class="form-control">
                        <input type="text" id="about" v-model="user.about">
                    </div>
                </div>

                <div class="form-group in-focus">
                    <label for="email">Email</label>
                    <div class="form-control">
                        <input type="text" id="email" v-model="user.email" required>
                    </div>
                </div>
                <div class="form-group in-focus">
                    <label for="file">Аватар</label>
                    <img :src="image" alt="" style="height: 200px;" v-if="image">
                    <div class="form-control">
                        <input type="file" id="file" accept="image/*" @change="handleImage">
                    </div>
                </div>
                <google-map @map="map" :autocomplete="true"></google-map>
                <button class="btn btn-primary">
                    Сохранить
                </button>
            </form>
        </div>
    </div>
</template>

<script>
  import GoogleMap from './../components/GMap';

  export default {
    data() {
      return {
        user: [],
        image:null,
        upload:null,
      }
    },
    components: {
      GoogleMap
    },
    created() {
      this.getData(this.$route.params.user);
    },
    methods: {
      getData(user) {
        axios
          .get(`/profile/${user}`)
          .then(({data}) => {
            this.user = data;
            this.image = data.image;
          })
      },
      map(data) {
        this.user.longitude = data.longitude;
        this.user.latitude = data.latitude;
      },
      handleImage(event) {
        if (event.target.files && event.target.files[0]) {
          const reader = new FileReader();

          reader.onload = function (e) {
            this.image = e.target.result;
            this.upload = e.target.result;
          }.bind(this);

          reader.readAsDataURL(event.target.files[0]);
        }
      },
      store() {
        const formData = {
          first_name: this.user.firstName,
          last_name: this.user.lastName,
          email: this.user.email,
          about: this.user.about,
          image: this.upload,
          longitude: this.user.longitude,
          latitude: this.user.latitude
        };
        axios.post(`profile/${user.id}`, formData);
      },
    },
  }
</script>
