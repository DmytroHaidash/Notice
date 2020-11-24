<template>
    <div class="selected" :class="{'active': open}">
        <div class="selected-value" @click="open = !open">{{valueSelected.title}}</div>
        <ul class="selected-list">
            <div v-for="item in items">
                <li class="selected-list__item"  @click="changeSelect(item)">
                    {{item.title}}
                </li>
                <div v-if="item.children">
                    <li class="selected-list__item"  @click="changeSelect(child)" v-for="child in item.children">
                        --{{child.title}}
                    </li>
                </div>
            </div>
        </ul>
    </div>
</template>
<script>

    export default {
        data() {
            return {
                valueSelected: '',
                open: false
            }
        },

        props: {
            value: Object,
            items: Array
        },

        created() {
            this.valueSelected = this.value;
        },

        mounted() {
            this.closeSelected();
        },

        methods: {
            changeSelect(value) {
                this.valueSelected = value;
                this.open = false;
                this.$emit('changeSelect', value)
            },
            closeSelected() {
                document.addEventListener('click', e => {
                    if (!(this.$el === e.target || this.$el.contains(e.target))) {
                        this.open = false;
                    }
                })
            }
        }
    }
</script>