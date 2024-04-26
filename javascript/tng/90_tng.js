// function AxiosGet() {
//     const URL = document.querySelector('#url').value;

//     axios.get(URL)
//     .then(res => {
//         console.log(res.data);
//         myMakeImg(res.data);
//     })
//     .catch(err => console.log(err));
// }

// function myMakeImg(data) {
//     data.forEach(item => {
//         // 부모요소 접근
//         const IMG_CON = document.querySelector('.img-con');

//         // img박스 생성
//         // const IMG = document.createElement('div');
//         // IMG.classList.add('img-box');
//         // IMG.style.width = '200px';
//         // IMG.style.height = '200px';
//         // IMG.style.backgroundColor = 'gray';

//         // img 넘버 생성
//         // const IMG_NO = document.createElement('div');
//         // IMG_NO.classList.add('img-no');
//         // IMG_NO.style.width = '100%';
        // IMG_NO.textContent = item.id;

//         // img 생성
//         const IMG = document.createElement('img');
//         IMG.setAttribute('src', item.download_url);
//         IMG.style.width = '200px';
//         IMG.style.height = '200px';

//         // img박스 img-con에 추가
//         // IMG.appendChild(IMG_CON);
//         IMG.appendChild(IMG_CON);
//         //img넘버 img-box에 추가
//         // IMG_NO.appendChild(IMG);
//     });
// }

// // 버튼 클릭시 이미지 생성
// const BTN_SUB = document.querySelector('.submit');
// BTN_SUB.addEventListener('click', AxiosGet);

function myAxiosGet() {
    // URL획득
    const URL = document.querySelector('#url').value;

    // Axios 처리
    axios.get(URL)
    .then(response => {
        console.log(response.data);
        myMakeImg(response.data);
    })
    .catch(err => console.log(err));
}

// 사진 데이터를 화면에 추가 함수
function myMakeImg(data) {
    data.forEach(item => {
        // 부모요소 접근
        // const IMG = document.querySelector('.add-img');
        const IMG_CON = document.querySelector('.img-con');

        const IMG_BOX = document.createElement('div');
        IMG_BOX.setAttribute('id', 'img-box');

        //넘버
        const IMG_NO = document.createElement('p');
        IMG_NO.textContent = item.id;

        //img 태그 생성
        const ADD_IMG = document.createElement('img');
        ADD_IMG.setAttribute('src', item.download_url);
        ADD_IMG.style.width = '300px';

        IMG_CON.appendChild(IMG_BOX);
        //넘버 추가
        IMG_BOX.appendChild(IMG_NO);
        // 이미지 화면에 추가
        IMG_BOX.appendChild(ADD_IMG);
    });
}

function imgBox() {
    () => {
        const IMG_CON = document.querySelector('.img-con');

        const ADD_BOX = document.createElement('div');
        ADD_BOX.classList.add('img-box');
        
        IMG_CON.appendChild(ADD_BOX);
    }
}

const BTN_API = document.querySelector('.submit');
BTN_API.addEventListener('click', myAxiosGet);

const BTN_DEL = document.querySelector('.remove');

function A() {
    
} 