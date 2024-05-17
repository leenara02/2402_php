<template>
<h1>프로바이더 테스트</h1>
<h3>{{ test.count }}</h3>
<button @click="test.addCount">프로바이더 증가</button>
<button @click="test.minusCount">프로바이더 감소</button>
    
</template>

<script setup>
import { inject } from 'vue';


const test = inject('test');

</script>

<style>
    
</style>