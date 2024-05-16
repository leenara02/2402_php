<template>
<!-- html -->
  <img alt="Vue logo" src="./assets/logo.png">
  <!-- 헤더 -->
  <!-- props :  자식 컴포넌트에게 props 속성을 이용해서 데이터를 전달(콜론 키명) -->
  <HeaderComponent :navList="navList" /> <!-- 키명, 전달할 리액티브값 -->
  <!-- <div class="nav">
    <a v-for="item in navList" :key="item.navName" href="#" >{{ item.navName }}</a>
  </div> -->

  <!-- 상품 리스트 -->
  <div>
    <div v-for="item in products" :key="item.productName"> <!-- PK개념으로 사용할 키를 작성 -->
      <h4 @click="myOpenModal(item)">{{ item.productName}}</h4>
      <p>{{ item.price }} 원</p>
    </div>
  </div>

  <!-- 모달 -->
  <!-- html 속성을 뷰속성으로 바꿔주러면 속성앞에 콜론을 붙인다.(v-on이 생략되어있다.) -->
  <!-- <div class="bg_black" v-if="flgModal">
    <div class="bg_white">
      <img :src="product.img"> 
      <h4>{{ product.name }}</h4>
      <p>{{ product.productContent }}</p>
      <p>{{ product.price }} 원</p>
      <button @click="flgModal = !flgModal">닫기</button>
    </div>
  </div> -->
  <ModalDetail
    :modal="product"
    :flgModal="flgModal"
  />
</template>


<script setup>
// 자바스크립트
import { ref,reactive } from 'vue';
import HeaderComponent from './components/HeaderComponent.vue'; // 자식 컴포넌트 import
import ModalDetail from './components/ModalDetail.vue';

// --------------------------
// 데이터 바인딩
// --------------------------
// ref : 타입제한 없이 사용가능하나 일반적으로 string, number, boolean 과 같은 기본유형에 대한 반응적 참조를 위해 사용
// import{ ref } from 'vue';
// const pants = ref('청바지');
// const price = ref(10000);

// reactive : 객체 타입만 사용 가능하며, 해당 객체에 대한 반응적 참조를 위해 사용

const products = reactive([
  {productName: '바지', price: 10000, productContent: '매우 아름다운 바지 입니다.', img: require('@/assets/img/P.jpg')},
  {productName: '티셔츠', price: 5000, productContent: '매우 아름다운 티셔츠 입니다.', img: require('@/assets/img/T.jpg')},
  {productName: '양말', price: 1000, productContent: '매우 아름다운 양말 입니다.', img: require('@/assets/img/S.jpg')},
]);
// console.log(products[0].price);

// --------------------------
// 헤더 처리
// --------------------------
const navList = reactive([
  {navName: '홈'},
  {navName: '상품'},
  {navName: '기타'},
]);

// --------------------------
// 모달용
// --------------------------
const flgModal = ref(false); // 모달 표시용 플래그
let product = reactive({}); // 상수로 선언하면 객체가 바뀌지않기 때문에 let으로 선언.
function myOpenModal(item) {
  flgModal.value = !flgModal.value;
  product = item;
}

</script>

<style>
/* CSS */
@import url('./assets/css/common.css');
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
/* css 파일 따로 분리 */
/* .nav {
  background-color: #363635;
  padding: 15px;
  border-radius: 10px;
}
.nav a {
  color: #fff;
  padding: 10px;
  text-decoration: none;
} */
</style>
