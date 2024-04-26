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

// 콜백지옥 개선
// setTimeout(() => {
//     console.log('A');
//     setTimeout(() => {
//         console.log('B');
//         setTimeout(() => {
//             console.log('C')
//         }, 1000);
//     }, 2000);
// }, 3000);

// promise
const PRO2 = (str, ms) => {
    return new Promise((resolve) => {
        setTimeout(() => {
            console.log(str);
            resolve();
        }, ms);
    }, ms);
}

// PRO2('A', 3000)
// .then(() => PRO2('B', 2000))
// .then(() => PRO2('C', 1000))
// .catch(() => console.log('ERROR'))
// .finally(() => console.log('Finally'));

// 병렬 처리 방법(Promise.all())
const myLoop = cnt => {
    for(let i = 0; i < cnt; i++){

    }
    console.log('루프종료 : ' + cnt);
}

// myLoop(100000000);
// myLoop(10000000);
// myLoop(10000);

Promise.all([myLoop(100000000), myLoop(10000000), myLoop(10000)]);