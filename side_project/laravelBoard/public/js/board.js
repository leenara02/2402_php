// 상세 모달 처리
document.querySelectorAll(".my-btn-detail").forEach(item => {
    item.addEventListener('click', () => {
        const url = '/board/'+item.value;
        //체이닝
        axios.get(url)
        .then(response => {
            const data = response.data;
            
            // id는 고유하기 때문에 여러군데서 같은이름을 사용할 수 없다.!!!!!!
            const btnDelete = document.querySelector('#my-btn-delete'); // 삭제 버튼 
            const btnRetouch = document.querySelector('#my-btn-retouch'); // 삭제 버튼 
            const modalTitle = document.querySelector('.modal-title'); // 제목 노드
            const modalContent = document.querySelector('.modal-body > p'); // 내용 노드
            const modalImg = document.querySelector('.modal-body > img'); // 이미지 노드

            // 상세정보 셋팅

            modalTitle.textContent = data.title;
            modalContent.textContent = data.content;
            modalImg.src = data.img;

            // 삭제버튼
            if(data.auth_id !== data.user_id) {
                btnDelete.classList.add('d-none');
                btnDelete.value = '';
                btnRetouch.classList.add('d-none');
            } else {
                btnDelete.classList.remove('d-none');
                btnDelete.value = data.id;
                btnRetouch.classList.remove('d-none');
            }
        })
        .catch(err => console.log(err));
    });
});

// 삭제처리 (async로 한번 해보자)
// document.querySelector('#my-btn-delete').addEventListener('click', myDeleteCard);

// async function myDeleteCard(e) {
//     console.log(e.target.value);

//     const url = '/board/delete'; // url 설정

//     const data = new FormData(); // form 설정
//     data.append('id', e.target.value); // board id 셋팅

//     try {
//         const response = await axios.post(url, data);
//         console.log(response.data);

//         if(response.data.errorFlg){
//             // 에러일 경우
//             alert('삭제 실패');
//         } else {
//             // 정상일경우
//             const main = document.querySelector('main'); // 부모요소
//             const card = document.querySelector('#card' + response.data.b_id); // 삭제할 요소
//             main.removeChild(card);            
//         }
//     } catch (error) {
//         console.log(error);
//     }
    
// }
