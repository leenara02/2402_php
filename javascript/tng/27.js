// 원본은 보존하면서 오름차순 정렬 해주세요.
const ARR1 = [ 6, 3, 5, 8, 92, 3, 7, 5, 100, 80, 40 ];

const ARR1_A = [...ARR1];

let result = ARR1_A.sort((a,b) => a-b);
console.log(ARR1);
console.log(result);


// 짝수와 홀수를 분리해서 각각 새로운 배열 만들어 주세요.
const ARR2 = [5,7,3,4,5,1,2];

result = ARR2.filter(val => val%2 === 0);
console.log(result);

result = ARR2.filter(val => val%2 !== 0);
console.log(result);