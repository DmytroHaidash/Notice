<template>
    <div class="content-col">
        <div class="content-body">
            <form @submit.prevent="store">
                <div class="form-group in-focus">
                    <label for="title">Заголовок</label>
                    <div class="form-control">
                        <input type="text" id="title" v-model="title" >
                    </div>
                </div>
                <div class="form-group in-focus">
                    <label for="description">Описание</label>
                    <div class="form-control">
                        <textarea id="description" rows="5" v-model="description" required></textarea>
                    </div>
                </div>
                <div class="product-header-item">
                    <div class="product-header-item__title product-header-item__title--flex">
                        Категория:
                        <div class="size">
                            <selected @changeSelect="checkCategory" v-if="categories" :value="category"
                                      :items="categories"></selected>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group in-focus">
                            <label for="phone">Телефон</label>
                            <div class="form-control">
                                <input type="tel" id="phone" v-model="phone" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group in-focus">
                            <label for="country">Страна</label>
                            <div class="form-control">
                                <input type="text" id="country" v-model="country" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group in-focus">
                            <label for="email">E-mail</label>
                            <div class="form-control">
                                <input type="email" id="email" v-model="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group in-focus">
                            <label for="end_date">Дата окончания</label>
                            <div class="form-control">
                                <input type="date" id="end_date" v-model="end_date" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group in-focus">
                    <label for="file">Изображение</label>
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
  import Selected from './../components/Selected';

  export default {
    data() {
      return {
        title: '',
        description: '',
        phone: null,
        country: '',
        email: '',
        end_date: '',
        image: null,
        upload: null,
        latitude: null,
        longitude: null,
        categories: null,
        category: null,
      }
    },
    components: {
      GoogleMap,
      Selected
    },
    methods: {
      checkCategory(category) {
        this.category = category;
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
      map(data) {
        this.longitude = data.longitude;
        this.latitude = data.latitude;
      },
      store() {
        const formData = {
          title: this.title,
          description: this.description,
          phone: this.phone,
          country: this.country,
          email: this.email,
          end_date: this.end_date,
          image: this.upload,
          longitude: this.longitude,
          latitude: this.latitude,
          category_id: this.category.id
        };
        if (this.$route.params.advertisement) {
          axios.put(`/advertisements/${this.$route.params.advertisement}`, formData)
            .then(res => {
              if (res.status === 200) {
                this.$router.push('/');
              }
            })
            .catch((error) => {
              alert(error.response.data.errors.title);
            });
        } else {
          axios.post('/advertisements', formData)
            .then(res => {
              if (res.status === 200) {
                this.$router.push('/');
              }
            })
            .catch((error) => {
              alert(error.response.data.errors.title);
            });
        }
      },
      getData(advertisement) {
        axios
          .get(`/advertisements/${advertisement}`)
          .then(({data}) => {
            this.advertisement = data;
            this.title = data.title;
            this.description = data.description;
            this.phone = data.phone;
            this.country = data.country;
            this.email = data.email;
            this.end_date = data.end_date;
            this.image = data.image;
            this.longitude = data.longitude;
            this.latitude = data.latitude;
            this.category = data.category;
          });
      },
      getCategories() {
        axios
          .get('/categories/parents')
          .then(({data}) => {
            this.categories = data;
            this.category = this.categories[0];
          });
      }
    },
    created() {
      if (!this.$attrs.auth) {
        this.$router.push('/');
      }
      this.getCategories();
      if (this.$route.params.advertisement) {
        this.getData(this.$route.params.advertisement)
      }
    }
  }
</script>
<style scoped>
    .product-header-item {
        margin-bottom: 50px;
        width: 90%
    }
</style>