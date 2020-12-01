<template>
    <router-link :to="{path: '/favorites'}" class="favorite" v-if="count">
        <span class="badge badge-dark">{{count}}</span>
        <svg width="30" height="30">
            <use xlink:href="#heart"></use>
        </svg>
    </router-link>
</template>

<script>
  export default {
    data() {
      return {
        count: null,
      }
    },
    methods: {
      getFavorite() {
        axios.get('/favorite/count')
          .then(({data}) => {
            this.count = data;
          })
      },
      checkCount(){
        if(+this.count > 99){
          this.count = '99+';
        }
      }
    },
    created() {
      this.getFavorite();
      VBus.$on('changeFavorite', () => {
        this.getFavorite();
      })
    }
  }
</script>

<style scoped lang="scss">
    .favorite{
        display: block;
        position: relative;

        svg {
            fill: #888;
            transition: 0.35s;

            &:hover svg {
                fill: #dc3545;
            }
        }
    }

    .badge {
        position: absolute;
        top: -6px;
        right: -20px;
        width: 20px;
        height: 20px;
        font-size: 11px;
        line-height: 20px;
        padding: 0;

        &-dark{
            color:#fff;
            background-color: #ae662d;
            border-radius:25%;
            padding-left: 5px;
        }
    }
</style>