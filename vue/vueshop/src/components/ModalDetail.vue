<template>
  <div class="bg_black" v-if="modal.flgModal">
    <div class="bg_white">
      <img :src="modal.modal.img">
      <h4>{{ modal.modal.productName }}</h4>
      <p>{{ modal.modal.productContent }}</p>
      <p>{{ modal.modal.price }} 원</p>
      <!-- <button @click="flgModal = !flgModal">닫기</button> -->
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';

const modal = defineProps({
  'modal': Object,
  'flgModal': Boolean
});

</script>

<style>

</style>