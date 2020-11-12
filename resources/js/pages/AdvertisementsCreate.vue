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
                        <textarea id="description" rows="5"  v-model="description" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <div class="form-control">
                        <input type="text" id="phone" v-model="phone" @focus="onFocus()" @blur="onBlur()"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="country">Страна</label>
                    <div class="form-control">
                        <input type="text" id="country" v-model="country" @focus="onFocus()" @blur="onBlur()"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="form-control">
                        <input type="email" id="email" v-model="email" @focus="onFocus()" @blur="onBlur()"
                               required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="end_date">Дата окончания</label>
                    <div class="form-control">
                        <input type="date" id="end_date" v-model="end_date" @focus="onFocus()" @blur="onBlur()"
                               required>
                    </div>
                </div>
                <button class="btn btn-primary">
                    Сохранить
                </button>
            </form>
        </div>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        title: '',
        description: '',
        phone: null,
        country: '',
        email: '',
        end_date: null,
      }
    },
    methods: {
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


        this.$router.push('../');
      }
    }
  }
</script>
