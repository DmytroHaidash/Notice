<template>
    <div >
        <svg width="30" height="30" @click.prevent="addToFavorite">
            <use :xlink:href="favorited ? '#heart' : '#no-heart'"></use>
        </svg>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        favorited: false
      }
    },
    props: {
      advertisement: Object,
    },
    methods: {
      addToFavorite() {
        axios.post(`/favorite/${this.advertisement.id}`)
          .then(() => {
            this.favorited = !this.favorited;
          });

        VBus.$emit('changeFavorite');
      },
      checkFavorite() {
        axios.get(`/favorite/${this.advertisement.id}`)
          .then(({data}) => {
            this.wishlisted = data;
          })
      },
    },
    created() {
      this.checkFavorite();
    }
  }
</script>

<style scoped lang="scss">
    svg {
        fill: transparent;
        stroke: #222;
        transition: .5s;

        &:hover {
            stroke: #fff;
        }
    }
    svg {
        position: relative;
        left: 20px;
        right: 0;
        transition: 0.5s;
        margin: auto;
        fill: #fff;
    }
</style>