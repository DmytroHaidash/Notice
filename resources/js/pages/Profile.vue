<template>
    <div class="content-col">
        <div class="content-body">
            <form @submit.prevent="store">
                <img :src="image" alt="" style="height: 200px; margin-bottom:15px;" v-if="!edit">
                <div class="form-group in-focus">
                    <label for="first_name">Имя</label>
                    <div class="form-control" v-if="edit">
                        <input type="text" id="first_name" v-model="user.firstName" required>
                    </div>
                    <p v-else>{{user.firstName}}</p>
                </div>
                <div class="form-group in-focus">
                    <label for="last_name">Фамилия</label>
                    <div class="form-control" v-if="edit">
                        <input type="text" id="last_name" v-model="user.lastName" required>
                    </div>
                    <p v-else>{{user.lastName}}</p>
                </div>
                <div class="form-group in-focus">
                    <label>О себе</label>
                    <div class="form-control" v-if="edit">
                        <wysiwyg name="about" :content="user.about" style="width:80%;" @wysiwyg="getWysiwyg"></wysiwyg>
                    </div>
                    <div v-else v-html="user.about"></div>
                </div>
                <div v-if="edit">
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
                </div>
            </form>
        </div>
    </div>
</template>

<script>
  import GoogleMap from './../components/GMap';
  import Wysiwyg from './../components/TinyMCE';

  export default {
    data() {
      return {
        user: [],
        image: null,
        upload: null,
        edit: false,
      }
    },
    components: {
      GoogleMap,
      Wysiwyg
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
            this.edit = (this.$attrs.auth.id === this.user.id);
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
      getWysiwyg(data) {
        this.user.about = data;
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
        axios.post(`profile/${this.user.id}`, formData);
        this.$router.push('/');
      },
    },
  }
</script>
