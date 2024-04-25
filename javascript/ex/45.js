// Promise 객체
// true/ false로 나온다.
// 정상처리, 예외처리
// 콜백지옥을 개선하기위해 등장한 기법
// JS의 비동기 프로그래밍에서 근간이 되는 기법


// promise객체 생성
const PRO = (str, ms) => {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            if(str === 'A') {
                resolve('성공 : A임');
            } else {
                reject('tlfvo : A아님');
            }
        }, ms);
    });
}

// Promise 호출
PRO('A', 1000)
.then(result => console.log('then : ' + result)) // resolve가 호출됐을 때
.catch(err => console.log('catch : ' + err)) // reject가 호출됐을 때
// const RESULT = PRO();