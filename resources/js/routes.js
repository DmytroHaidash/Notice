import Advertisements from './pages/Advertisements';
import Advertisement from './pages/Advertisement';
import PageNotFound from './pages/PageNotFound.vue';
import Create from './pages/AdvertisementsCreate';
import Profile from './pages/Profile';
import Categories from './pages/Categories';

const routes = [
  {path: '/', component: Advertisements, name:'home'},
  {path: '/advertisements/create', component: Create},
  {path: '/advertisements/edit/:advertisement', component: Create},
  {path: '/advertisements/:advertisement', component:Advertisement},
  {path: '/profile/:user', component:Profile},
  {path: '/categories', component:Categories},
  {path: '*', component: PageNotFound},
];

export default routes;