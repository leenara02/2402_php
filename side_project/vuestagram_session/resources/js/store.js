import { createStore } from 'vuex';
import router from './router';

const store = createStore({
    state() {
        return {
            authFlg: document.cookie.indexOf('auth=') >= 0 ? true : false , // 쿠키에 auth여부로 로그인현황 관리(리프레시 해도 안없어진다)
            userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : null, 
            boardData: [], //루프,관리,접근이 쉽기때문에 배열사용.
            moreBoardFlg: true,
        }
    },
    mutations: {
        // 유저 정보 저장
        setAuthFlg(state, flg){
            state.authFlg = flg;
        },
        setUserInfo(state, userInfo){
            state.userInfo = userInfo; // state에 있는 유저인포 = 파라미터로 오는 유저인포
        },
        // 게시글 초기 삽입
        setBoardData(state, data){
            state.boardData = data; // 배열 형태임
        },
        // 더보기 버튼 플래그
        setMoreBoardFlg(state, flg){
            state.moreBoardFlg = flg;
        },
        // 게시글 추가
        setMoreBoardData(state, data) {
            state.boardData = [...state.boardData, ...data];
        },
    },
    actions: {
        /**
         * 로그인 처리
         * @param {*} context 
         */
        login(context){
            const url = '/api/login';
            const form = document.querySelector('#loginForm');
            const data = new FormData(form);

            axios.post(url, data)
            .then(response => {
                console.log(response.data); // TODO
                localStorage.setItem('userInfo', JSON.stringify(response.data.data));
                context.commit('setUserInfo', response.data.data); // mutations 에 넘겨줄 값
                context.commit('setAuthFlg', true); // flg갱신

                router.replace('/board'); // 히스토리 남기지 않고 보드로 이동
            })
            .catch(error => {
                console.log(error.response); // TODO
                alert('로그인 실패. ( ' + error.response.data.code + ' )');
                // 리다이렉트 할 필요가 없기 때문에 이동처리 x
            });
        },
        
        /**
         * 로그아웃
         * @param {*} context 
         */
        logout(context){
            const url = '/api/logout';

            axios.post(url)
            .then(response => {
                console.log(response.data); // TODO
            })
            .catch(error => {
                console.log(error.response); // TODO
                alert('문제발생. 로그아웃. ( ' + error.response.data.code + ' )');
                // 리다이렉트 할 필요가 없기 때문에 이동처리 x
            })
            .finally(() => {
                localStorage.clear();

                context.commit('setAuthFlg', false);
                context.commit('setUserInfo', null);

                router.replace('/login');
            })
        },

        /**
         * 최초 게시글 획득
         * @param {*} context 
         */
        getBoardData(context){
            const url = '/api/board';
            
            axios.get(url)
            .then(response => {
                console.log(response.data); // TODO
                context.commit('setBoardData', response.data.data);

            })
            .catch(error => {
                console.log(error.response); // TODO
                alert('게시글 습득에 실패 ( ' + error.response.data.code + ' ) ');
            })
        },

        /**
         * 추가 게시글 획득
         * @param {*} context 
         */
        getMoreBoardData(context){

            const lastItem = context.state.boardData[context.state.boardData.length -1];
            const url = '/api/board/' + lastItem.id;

            axios.get(url)
            .then(response => {
                console.log(response.data); // TODO
                context.commit('setMoreBoardData', response.data.data);

                // 더보기 버튼 플래그 갱신
                if(response.data.data.length < 20){
                    context.commit('setMoreBoardFlg', false);
                }
            })
            .catch(error => {
                console.log(error.response.data); // TODO
                alert('추가 게시글 획득 실패 ( ' + error.response.data.code + ' )');
            })
        },
    }
});

export default store;
