import { createStore } from "vuex";
import axios from './axios';
import router from './router';

const store = createStore({
    state() {
        return {
            authFlg: localStorage.getItem('accessToken') ? true : false, //true면 접속중
            userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : {},
        }
    },
    mutations: {
        // -------------------------
        // 인증관련
        // -------------------------
        setAuthFlg(state, boo) {
            state.authFlg = boo;
        },
        setUserInfo(state, userInfo) {
            state.userInfo = userInfo;
        }

    },
    actions: {
        // -------------------------
        // 인증관련
        // -------------------------
        /**
         * 로그인
         * 
         * @param {*} context 
         * @param {*} userInfo 
         */
        login(context, userInfo) {
            const url = '/api/login';
            axios.post(url, JSON.stringify(userInfo))
            .then(response => {
                // console.log(response.data);
                // localStorage : 유저 PC 저장소 (문자열만 저장됨.) / 새로고침해도 유지
                localStorage.setItem('accessToken', response.data.accessToken);
                localStorage.setItem('refreshToken', response.data.refreshToken);
                localStorage.setItem('userInfo', JSON.stringify(response.data.data));

                // state 갱신
                context.commit('setAuthFlg', true);
                context.commit('setUserInfo', response.data.data);
                router.replace('/board'); // 히스토리를 안남긴다.

            })
            .catch(error => {
                console.log(error.response);
                const errorCode = error.response.data.code ? error.response.data.code : 'FE99';
                alert('로그인 실패 : '+errorCode);
            })
        }
    }
});

export default store;