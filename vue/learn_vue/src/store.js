import { createStore } from "vuex";

const store = createStore({
    state() {
        // 데이터가 저장되는 영역
        return {
            account: '',
        }
    },
    mutations: {
        // 데이터를 수정할 수 있는 함수들을 정의하는 영역
        // 함수function을 제외 하고 함수명 부터 적으면 됨.
        // 첫번째 파라미터는 무조건 state다. state영역을 의미.
        setAccount(state, account) {
            state.account = account;
        }
    },
    actions: {
        // 비동기성 비지니스 로직 함수들을 정의하는 영역


    }
});

// 내보내기
export default store;