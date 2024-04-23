// Date 객체
// Unix 타임스탬프 기반으로 동작 1970 01 01 00:00:00 밀리초 단위

// 요일 한글로 변환 함수
const CHANGE_DAY_TO_KOREAN_DAY = num => {
    switch(num) {
        case 0:
            return '일요일';
        case 1:
            return '월요일';
        case 2:
            return '화요일';
        case 3:
            return '수요일';
        case 4:
            return '목요일';
        case 5:
            return '금요일';
        case 6:
            return '토요일';
    }
}

// 앞에 0을 추가해주는 함수
const LpadZero = (val,length) => {
    return String(val).padStart(length, '0');             // string으로 바꿔준다.
}
function lpadZero(val, length) {
    return String(val).padStart(length, '0');
} // PHP때 쓰던 방식


// 현재날짜/시간 획득
const NOW = new Date();
console.log(NOW); // Tue Apr 23 2024 10:37:44 GMT+0900 (한국 표준시)

// getFullYear() : 연도만 가져오는 메소드 (YYYY)
const YEAR = NOW.getFullYear();
console.log(YEAR); // 2024

// getMonth() : 월만 가져오는 메소드, 0~11을 획득
const MONTH = LpadZero(NOW.getMonth() + 1, 2);
console.log(MONTH); // 4

// getDate() : 일만 가져오는 메소드
const DATE = LpadZero(NOW.getDate(), 2);
console.log(DATE); // 23

// getHours() : 시를 가져오는 메소드
const HOUR = LpadZero(NOW.getHours(), 2);
console.log(HOUR); // 10

// getMinutes() : 분을 가져오는 메소드
const MINUTE = LpadZero(NOW.getMinutes(), 2);
console.log(MINUTE); // 46

// getSeconds() : 초를 가져오는 메소드
const SECOND = LpadZero(NOW.getSeconds(), 2);
console.log(SECOND); // 29

// getMilliseconds() : 밀리초를 가져오는 메소드
// 세자리까지 표시
const MILLISECONDS = LpadZero(NOW.getMilliseconds(), 3);
console.log(MILLISECONDS); // 695

// getDay() : 요일을 가져오는 메소드, 0(일) ~ 6(토) 반환
const DAY = NOW.getDay();
console.log(DAY);


// 조합 (날짜 포맷)
const FOMAT_DATE = `${YEAR}-${MONTH}-${DATE} ${HOUR}:${MINUTE}:${SECOND}:${MILLISECONDS} ${CHANGE_DAY_TO_KOREAN_DAY(DAY)} `;
console.log(FOMAT_DATE); //2024-04-23 10:52:29:025 화요일

// getTime() : UNIX 타임스탬프를 반환하는 메소드
const TIME = NOW.getTime(); // 밀리초단위

// 일수차이 계산
const TARGET_DATE = new Date('2024-04-03 00:00:00'); //Wed Apr 03 2024 00:00:00
// 버림(절대값(계산할날짜 - 지금날짜) / 24시 밀리초)
const DIFF_DATE = Math.floor(Math.abs(TARGET_DATE - NOW) / 86400000)

// 1000*60*60*24 = 86400000
// 밀리초 초 분 시 = 24시 밀리초

// 2024-01-01 13:00:00과 2025-05-30 00:00:00은 몇개월 후 입니까?
const TARGET_DATE2 = new Date('2024-01-01 13:00:00');
const TARGET_DATE2_1 = new Date('2025-05-30 00:00:00');
const DIFF_DATE2 = Math.floor(Math.abs(TARGET_DATE2 - TARGET_DATE2_1) / 2592000000);
console.log(DIFF_DATE2);

// 강사님 코드
const TARGET_DATE1 = new Date(2024, 0, 1, 13); // 년,월,일,시,분,초
const TARGET_DATE1_1 = new Date('2025-05-30');
const DIFF_DATE1 = Math.floor(Math.abs(TARGET_DATE1 - TARGET_DATE1_1) / (1000*60*60*24*30));
console.log(DIFF_DATE1);

