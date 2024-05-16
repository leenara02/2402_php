<template>
  <div class="nav">
    <a v-for="item in data.navList" :key="item.navName" href="#" >{{ item.navName }}</a>
  </div>
</template>

<script setup>
import { defineProps } from "vue";

const data = defineProps({
  'navList': Array // 부모한테 받아온 키 : 데이터타입
}); 

</script>

<style>
  
</style>

<!-- 컴포넌트 파일명은 무조건 두 단어 이상으로 작성해야함. -->
<!-- VueInit 치면 템플릿 만들어줌. 근데 옵션 기준이라서 우리가 만드는걸로 바꿔야함. -->
<!-- 그래서 그냥 직접 치는게 더 빠를수도있음. -->