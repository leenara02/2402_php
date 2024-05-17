<template>

  <div>
    <!-- slot : 부모 컴포넌트에서 자식 컴포넌트의 일부 구조를 동적으로 제어하기 위해 사용 -->
    <slot></slot> 
    <div v-for="item in props.products" :key="item.productName"> <!-- PK개념으로 사용할 키를 작성 -->
      <h4 @click="$emit('myOpenModal', item)">{{item.productName}}</h4>
      <p>{{ item.price }} 원</p>
    </div>
  </div>    
  <ProvideTest />
</template>

<script setup>
import { defineProps } from 'vue';
import ProvideTest from './ProvideTest.vue';

const props = defineProps({
  'products': Array // 부모한테 받아온 키 : 데이터타입
}); 
</script>


<style>

</style>