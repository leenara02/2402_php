// API호출 버튼 이벤트
const btnAPI = document.querySelector('#btn-api');
btnAPI.addEventListener('click', myGetData);

// API 호출
// function myGetData() {
//     const URL = document.querySelector('#input-url').value;

//     axios.get(URL)
//     .then(response => {
//         console.log(response);
//         myMakeItem(response.data);
//     })
//     .catch(err => console.log(err));
// }

// async/await 로 작성하는 방법
async function myGetData() {
    const URL = document.querySelector('#input-url').value;

    // API 요청
    try {
        const response = await axios.get(URL);
        myMakeItem(response.data);
    } catch (error) {
        console.log(error);
    }
}

function myMakeItem(data) {
    data.forEach(item => {
        // 아이템을 추가할 부모요소 획득
        const main = document.querySelector('.main');

        // 아이템 생성
        const newArticle = document.createElement('div');
        const newArticleId = document.createElement('div');
        const newArticleImg = document.createElement('img');

        // 아이템 data 셋팅
        newArticle.classList = 'article';
        newArticleId.classList = 'div-article-id';
        newArticleId.textContent = item.id;
        newArticleImg.classList = 'div-article-img';
        newArticleImg.src = item.download_url;

        // 생성한 요소 결합
        newArticle.appendChild(newArticleId); // 아티클에 아티클id 추가
        newArticle.appendChild(newArticleImg); // 아티클에 img 추가
        main.appendChild(newArticle); // 메인에 아티클 추가
    });
}

// 아이템 지우기
const btnClear = document.querySelector('#btn-clear');
btnClear.addEventListener('click', () => {
    // document.querySelector('.main').innerHTML = '';

    // 최대 5개까지 씩 지우기
    const main = document.querySelector('.main');
    const articleList = document.querySelectorAll('.article');
    // 노드리스트의 특성상 해당 정보를 불러온 시점에 데이터를 저장 하기 때문에
    // 아래 함수에서 삭제하더라도 length가 줄어들지않는다.

    for(let i = 0; i < 5; i++) {
        let idx = articleList.length - 1 - i; // index 계산
        if(idx < 0) {
            // index가 0보다 작으면 루프 종료
            break;
        }
        main.removeChild(articleList[idx]); // 해당 아티클 삭제
    }
});

