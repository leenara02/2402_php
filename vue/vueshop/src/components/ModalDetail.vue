<template>
  <Transition name="container">
    <div class="bg_black" v-if="props.flgModal">
      <div class="bg_white">
        <img :src="props.product.img">
        <h4>{{ props.product.productName }}</h4>
        <p>{{ props.product.productContent }}</p>
        <p>{{ props.product.price }} 원</p>
        <p>총액 : {{ props.product.price * cnt }} 원</p>
        <input type="number" min="1" v-model="cnt">
        <br><br>
        <button @click="close">닫기</button>
        <!-- 컴포넌트 이벤트 부모한테 요청 하는 문법 $emit('컴포넌트이벤트 키명') -->
        <!-- 컴포넌트이벤트 함수에 파라미터가 있으면 콤마 하고 아규먼트 이어주면 된다. -->
      </div>
    </div>
  </Transition>
</template>

<script setup>
import { defineProps, ref, defineEmits } from 'vue';

const props = defineProps({
  'flgModal': Boolean,
  'product': Object,
});

const emit = defineEmits(['myCloseModal']);

// 총액 처리 부분
const cnt = ref(1);

function close() {
  cnt.value = 1;
  emit('myCloseModal', props.product.productName);
}
</script>

<style>

.container-enter-from{
  opacity: 0;
}
.container-enter-active{
  transition: 0.5s ease;
}
.container-enter-to{
  opacity: 1;
}

.container-leave-from{
  transform: translateX(0px);
}
.container-leave-active{
  transition: all 2s;
}
.container-leave-to{
  transform: translateX(3000px);
}

</style>