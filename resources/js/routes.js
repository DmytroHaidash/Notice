import Advertisements from './pages/Advertisements';
import Advertisement from './pages/Advertisement';
import PageNotFound from './pages/PageNotFound.vue';
import Create from './pages/AdvertisementsCreate';
import Profile from './pages/Profile';
import Categories from './pages/Categories';
import Favorites from './pages/Favorites';

const routes = [
  {path: '/', component: Advertisements, name:'home'},
  {path: '/advertisements/:category', component: Advertisements},
  {path: '/advertisement/create', component: Create},
  {path: '/advertisement/edit/:advertisement', component: Create},
  {path: '/advertisement/:advertisement', component: Advertisement},
  {path: '/profile/:user', component: Profile},
  {path: '/categories', component: Categories},
  {path: '/favorites', component: Favorites},
  {path: '*', component: PageNotFound},
];

export default routes;