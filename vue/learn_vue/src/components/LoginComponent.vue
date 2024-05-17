<template>

    <h1>로그인</h1>
    <input type="text" v-model="inputData.account" placeholder="아이디">
    <br>
    <input type="text" v-model="inputData.password" placeholder="비밀번호">
    <br>
    <!-- commit() : 뮤테이션 불러오는 함수 -->
    <button @click="store.commit('setAccount', inputData.account)">로그인</button>
    <!-- v-modal은 양방향 연결이다. -->
    <!-- store.state는 웬만하면 v-model에서 사용을 안한다. -->

    <p>{{ store.state.account }}</p>
</template>

<script setup>
    import { reactive } from 'vue';
import { useStore } from 'vuex';

    const store = useStore();
    const inputData = reactive({
        account: '',
        password: '',
    });
</script>


<style>

</style>