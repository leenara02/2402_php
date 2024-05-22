import { createStore } from "vuex";
import axios from './axios';
import router from './router';

const store = createStore({
    state() {
        return {
            authFlg: localStorage.getItem('accessToken') ? true : false, //true면 접속중
            userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : {},
            boardList: [],
            lastID: localStorage.getItem('lastID') ? localStorage.getItem('lastID') : 0,
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
        },

        // -------------------------
        // 게시글 관련
        // -------------------------
        setBoardList(state, data) {
            state.boardList = data;
        },
        setLastID(state, id){
            state.lastID = id; 
        },


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
        },
        /**
         * 로그아웃 처리
         * 
         * @param {*} context 
         */
        logout(context) {
            const url = '/api/logout';
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }
            axios.post(url, null, config)
            .then(response => {
                console.log(response);
                alert('로그아웃 완료');
            })
            .catch(error => {
                console.log(error);
                console.log(error.response);
                alert('문제발생. 로그아웃합니다.');
            })
            .finally(() => {
                // 로컬스토리지 비우기
                localStorage.clear();
    
                // store state 초기화
                context.commit('setAuthFlg', false);
                context.commit('setUserInfo', {});
    
                // 로그인으로 이동 (히스토리 X)
                router.replace('/login');
            });
        },
        /**
         * 보드 리스트 정보 획득
         * 
         * @param {*} context 
         */
        getBoardList(context){

            // // 가장 마지막게시물 pk 획득
            // const boardList = context.state.boardList;
            // const boardCount = boardList.length;
            // const id = boardCount > 0 ? boardList[boardCount - 1].id : 0;

            const url = '/api/board/' + context.state.lastID + '/list';
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }
            
            axios.get(url, config)
            .then(response => {
                console.log(response);
                const data = response.data.data;
                context.commit('setBoardList', data);

                const id = data[data.length -1].id;
                localStorage.setItem('lastID', id);
                context.commit('setLsatID', id);
            })
            .catch(error => {
                console.log(error);
                console.log(error.response);
                const code = error.response ? error.response.data.code : '';
                alert('게시글 획득 실패.( '+ code +' )');
            });
        }
    }
});

export default store;