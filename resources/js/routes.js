import Advertisements from './pages/Advertisements';
import Advertisement from './pages/Advertisement';
import PageNotFound from './pages/PageNotFound.vue';
import Create from './pages/AdvertisementsCreate';

const routes = [
  {path: '/', component: Advertisements, name:'home'},
  {path: '/advertisements/create', component: Create},
  {path: '/advertisements/:advertisement', component:Advertisement},

  {path: '*', component: PageNotFound},
];

export default routes;