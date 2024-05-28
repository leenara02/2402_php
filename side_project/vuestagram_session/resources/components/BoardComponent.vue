<template>
  <!-- 상세 -->
  <div v-if="detailFlg" class="board-detail-box">
    <div class="item">
      <img :src="detailItem.img">
      <hr>
      <p>{{ detailItem.content }}</p>
      <hr>
      <div class="etc-box">
        <span>작성자 : {{ detailItem.name }}</span>
        <button @click="closeDetail()" class="btn btn-bg-black btn-close">닫기</button>
      </div>
    </div>
  </div>

  <!-- 리스트 -->
  <div class="board-list-box">
    <div @click="openDetail(item)" v-for="(item, key) in $store.state.boardData" :key="key" class="item">
        <img :src="item.img">
    </div>
  </div>
  <button v-if="$store.state.moreBoardFlg" @click="$store.dispatch('getMoreBoardData')" class="btn btn-bg-black btn-more" type="button">더보기</button>

</template>
<script setup>
import { onBeforeMount, reactive, ref } from 'vue';
import { useStore } from 'vuex';
// import store from '../js/store';

const store = useStore(); // store 사용 선언

let detailItem = reactive({}); // 모달 내용 담을 객체 초기화
let detailFlg = ref(false); // 모달 닫고 여는 플래그 초기화

// 모달 열기
function openDetail(data) {
  detailItem = data;
  detailFlg.value = true;
}
// 모달 닫기
function closeDetail() {
  detailItem = {}; // 메모리를 차지하고, 모달 열때 이전 데이터가 비치기 때문에 초기화 해주는게 좋음
  detailFlg.value = false;
}

onBeforeMount(() => {
  if(store.state.boardData.length < 1){
    store.dispatch('getBoardData');
  }
})
</script>
<style>
@import url('../css/boardList.css');
</style>
