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
            noMoreBoardListFlg: false,
        }
    },
    mutations: {
        // -------------------------
        // 인증관련
        // -------------------------
        setAuthFlg(state, boo) {
            state.authFlg = boo;
        },
        
        //--------------------------
        // 유저 정보 관련
        //--------------------------
        setUserInfo(state, userInfo) {
            state.userInfo = userInfo;
        },
        setUserBoardsCount(state) {
            state.userInfo.boards_count++;
        },
        // -------------------------
        // 게시글 관련
        // -------------------------
        setNoMoreBoardListFlg(state, flg) {
            state.noMoreBoardListFlg = flg;
        },
        setBoardList(state, data) {
            state.boardList = data;
        },
        setLastID(state, id){
            state.lastID = id; 
        },
        setConcatBoardList(state, data) {
            state.boardList = state.boardList.concat(data);
        },
        setUnshiftBoardList(state, data) {
            state.boardList.unshift(data);
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
                context.commit('setLastID', id);
            })
            .catch(error => {
                console.log(error);
                console.log(error.response);
                const code = error.response ? error.response.data.code : '';
                alert('게시글 획득 실패.( '+ code +' )');
            });
        },
        /**
         *  추가 게시글 리스트 획득
         * 
         * @param {*} context 
         */
        getAddBoardList(context) {

            const url = '/api/board/' + context.state.lastID;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            // axios 처리
            axios.get(url, config)
            .then(response => {
                const data = response.data.data;
                if(data.length > 0) {
                    // 게시글 정보가 있을 때 처리
                    context.commit('setConcatBoardList', data); // 추가 게시글 저장
                    context.commit('setLastID', data[data.length -1].id); // 마지막 게시글 id 저장
                    localStorage.setItem('lastID', data[data.length -1].id);
                } else {
                    // 게시글 정보가 없을 때 처리
                    // 더이상 게시글이 없을때 서버에 요청을 하지않기위한 플래그 true로 세팅
                    context.commit('setNoMoreBoardListFlg', true);
                    context.commit('setLastID', 0);
                    localStorage.removeItem('lastID');
                }
                console.log('서버');
            })
            .catch(error => {
                console.log(error);
                console.log(error.response);
                const code = error.response ? error.response.data.code : '';
                alert('게시글 획득 실패.( '+ code +' )');
            });
        },
        /**
         * 게시글 작성
         * 
         * @param {store} context 
         * @param {object} boardInfo 
         */
        storeBoard(context, boardInfo) {
            const url = '/api/board';
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }
            const data = new FormData();
            data.append('content',boardInfo.content);
            data.append('img', boardInfo.img);
            console.log(boardInfo);

            // axios 처리
            axios.post(url, data, config)
            .then(response => {
                if(context.state.boardList.length > 1){
                    context.commit('setUnshiftBoardList', response.data.data); // 보드리스트의 가장 앞에 작성한 글 정보 추가
                } // 여기 if 안넣고 BoardComponent onBeforeMount에 1보다 작거나 같다로 해도 됨. 단 게시물이 두개 이상일때.
                context.commit('setUserBoardsCount'); // 유저의 작성글 수 1 증가
                localStorage.setItem('userInfo', JSON.stringify(context.state.userInfo));

                router.replace('/board');
            })
            .catch(error => {
                // console.log(error);
                // console.log(error.response);
                const code = error.response ? error.response.data.code : '';
                alert('게시글 작성 실패.( '+ code +' )');
            });
        }
    }
});

export default store;