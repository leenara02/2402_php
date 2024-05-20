<template>
    <div class="form-box">
        <p class="form-title">로그인</p>
        <input v-model="userInfo.account" type="text" name="account" id="" placeholder="아이디">
        <input v-model="userInfo.password" type="password" name="password" id="" placeholder="패스워드">
        <!-- app.js에서 use(store) 했던걸 $로 가지고온다. -->
        <button @click="$store.dispatch('login', userInfo)" class="btn btn-submit btn-bg-black">로그인</button>
    </div>
</template>

<script setup>
import { reactive } from 'vue';

const userInfo = reactive({
    account: '',
    password: '',
});
</script>

<style>
</style>