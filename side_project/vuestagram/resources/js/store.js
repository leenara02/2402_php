import { createStore } from "vuex";

const store = createStore({
    state() {
        return {

        }
    },
    mutations: {

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
            console.log(JSON.stringify(userInfo));
            const url = '/api/login';
        }
    }
});

export default store;