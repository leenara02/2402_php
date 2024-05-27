import { createWebHistory, createRouter } from "vue-router";
import LoginComponent from '../components/LoginComponent.vue';
import BoardComponent from "../components/BoardComponent.vue";
import BoardCreateComponent from "../components/BoardCreateComponent.vue";
import UserRegistration from "../components/UserRegistration.vue";
import store from "./store";

function chkAuth(to, from, next) {
    if(!store.state.authFlg) {
        next('/login');
    }
    // next : 파라미터로 지정경로를 주면 지정경로로 가고 경로를 안주면 원래 이동하려고 했던 경로로 이동하게된다.
    next();
}
function chkAuthReturn(to, from, next) {
    if(store.state.authFlg) {
        if(from.path === '/'){
            next('board');
        }
        next(from.path);
    }
    next();
}

const routes = [
    {
        path: '/',
        redirect: '/login',
    },
    {
        path: '/login',
        component: LoginComponent,
        beforeEnter: chkAuthReturn,
    },
    {
        path: '/board',
        component: BoardComponent,
        // beforeEnter : 라우터가 실행되기 전에 실행할 소스코드(권한체크 등)
        beforeEnter: chkAuth,
    },
    {
        path: '/create',
        component: BoardCreateComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/regist',
        component: UserRegistration,
        // beforeEnter: chkAuth,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes, 
});

export default router;