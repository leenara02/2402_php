// Math 객체

// 올림 , 반올림, 버림
Math.ceil(0.1); // 1
Math.round(0.5); // 1
Math.floor(0.9); // 0

// 랜덤값
Math.random(); // 0~1사이에 랜덤한 수를 반환
// 1 ~ 10 랜덤 숫자 획득
Math.ceil(Math.random() * 10);

for(let i = 0; i<10; i++){
    console.log(Math.ceil(Math.random() * 10));
}

// 최대값, 최소값, 절대값
const ARR = [3,43,5,46,4,23,423,267,5,4,3,3,2];
let max = Math.max(...ARR); // 원본말고 복사해서 보내야함
console.log(max);

let min = Math.min(...ARR);
console.log(min);

// 앞에 부호를 제외한 숫자
// 날짜계싼 할때 사용
// 현재와 과거의 날짜차이를 계산할때 음수가 나올 수 있기 때문에
// abs로 부호를 없앤다.
Math.abs(1); // 1
Math.abs(-1); // 1

