<template>
  <h1>구글 로그인 테스트</h1>
  <button @click="linkLogin">구글 로그인</button>
  <button @click="linkBoard">보드</button>
  <router-view></router-view>
</template>

<script setup>
import { useRouter } from 'vue-router';
const router = useRouter();

function linkLogin() {
  router.push('/googlelogin');
}
function linkBoard() {
  router.replace('/board');
}

</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
