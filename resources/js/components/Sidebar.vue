<template>
    <div class="sidebar-col">
        <div class="sidebar">
            <div class="menu">
                <div class="nav">
                    <ul class="nav-list">
                        <li>
                            <router-link to='/' exact>Обьявления</router-link>
                        </li>
                        <li v-if="$attrs.auth">
                            <router-link to="/advertisements/create">Cоздать объявление</router-link>
                            <router-link to="/categories">Категории</router-link>
                        </li>
                    </ul>
                    <div class="copyright">
                        2020 Все права защищены
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
      //
    }
</script>
