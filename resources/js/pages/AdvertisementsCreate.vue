<template>
    <div class="content-col">
        <div class="content-body">
            <form @submit.prevent="store">
                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <div class="form-control">
                        <input type="text" id="title" v-model="title" @focus="onFocus()" @blur="onBlur()"
                               required>
                    </div>
                </div>
                <div class="form-group in-focus">
                    <label for="description">Описание</label>
                    <div class="form-control">
                        <textarea id="description" rows="5" v-model="description" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <div class="form-control">
                                <input type="text" id="phone" v-model="phone" @focus="onFocus()" @blur="onBlur()"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="country">Страна</label>
                            <div class="form-control">
                                <input type="text" id="country" v-model="country" @focus="onFocus()" @blur="onBlur()"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <div class="form-control">
                                <input type="email" id="email" v-model="email" @focus="onFocus()" @blur="onBlur()"
                                       required>
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
                    <div class="form-control">
                        <input type="file" id="file" accept="image/*" @change="handleImage">
                    </div>
                </div>

                <google-map></google-map>
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
        title: '',
        description: '',
        phone: null,
        country: '',
        email: '',
        end_date: '',
        image: null
      }
    },
    components: {
      GoogleMap
    },
    methods: {
      handleImage(event) {
        if (event.target.files && event.target.files[0]) {
          const reader = new FileReader();

          reader.onload = function (e) {
            this.image = e.target.result;
          }.bind(this);

          reader.readAsDataURL(event.target.files[0]);
        }
      },
      onFocus() {
        event.target.parentNode.parentNode.classList.add('in-focus');
      },
      onBlur() {
        if (event.target.value !== "") {
          event.target.parentNode.parentNode.classList.add('in-focus');
        } else {
          event.target.parentNode.parentNode.classList.remove('in-focus');
        }
      },
      store() {
        const formData = {
          title: this.title,
          description: this.description,
          phone: this.phone,
          country: this.country,
          email: this.email,
          end_date: this.end_date,
          image: this.image,
        };
        axios.post('/advertisements/store', formData);
      }
    }
  }
</script>
