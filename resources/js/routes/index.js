import VueRouter from 'vue-router';
import Index from '../components/Index'
import NotFound from '../components/NotFound'

const routes = [
    {name: 'index', path: '/', component: Index},
    {name: 'short', path: '/short', component: Index},
    {name: 'not_found', path: '*', component: NotFound},
];

const router = new VueRouter({
    routes: routes,
    mode: 'history',
});

export default router;
