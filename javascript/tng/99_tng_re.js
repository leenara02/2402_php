let savedTime = null; // 스톱워치 시작시간 저장용(Date객체)
let intervalID; // 인터벌ID 저장용
let flgInterval = false; // 인터벌 실행 플래그
let stopTime = 0; // 스톱 당시 시간 저장용(TimeStamp)

function start() {
    // 첫 기동시 시작시간 현재시간으로 셋팅
    if(savedTime === null) {
        savedTime = new Date();
    }
    
    let now = new Date(); // 현재 시간 획득
    
    // 스톱 당시 시간 저장 여부 체크
    if(stopTime !== 0) {
        let diffStop = now - stopTime; // 현재와 스톱 당시 시간 차 획득
        savedTime = new Date(savedTime.getTime() +  diffStop); // 스톱워치 시작 시간에 (현재와 스톱 당시 시간 차) 추가
        stopTime = 0; // 스톱 당시 시간 초기화
    }

    // 화면 표시용 시간 계산
    let diff = Math.abs(now - savedTime);
    let time = new Date(diff);

    let hour = leftPad(time.getHours() - 9, '0', 2);
    let minute = leftPad(time.getMinutes(), '0', 2);
    let second = leftPad(time.getSeconds(), '0', 2);
    let milliSecond = leftPad(time.getMilliseconds(), '0', 2).substring(0, 2);

    // 화면에 출력
    let printTime = `${hour}:${minute}:${second}.${milliSecond}`;
    document.querySelector('h1').innerHTML = printTime;
}

function leftPad(target, fillStr, length) {
    return String(target).padStart(length, fillStr);
}

// start 버튼
document.querySelector('#start').addEventListener('click', () => {
    // 실행중인 인터벌이 없을 경우 실행
    if(!flgInterval) {
        intervalID = setInterval(start, 10); // 인터벌 추가
        flgInterval = true; // 인터벌 실행 플래그 온
    }
});

// stop 버튼
document.querySelector('#stop').addEventListener('click', () => {
    // 실행중인 인터벌이 있을 경우 실행
    if(flgInterval) {
        clearInterval(intervalID); // 인터벌 제거
        flgInterval = false; // 인터벌 실행 플래그 오프

        // 스탑 당시 시간 TimeStamp로 저장
        let now = new Date();
        stopTime = now.getTime();
    }
});

// reset 버튼
document.querySelector('#reset').addEventListener('click', () => {
    // 실행중인 인터벌이 있을 경우 실행
    if(flgInterval) {
        clearInterval(intervalID); // 인터벌 제거
        flgInterval = false; // 인터벌 실행 플래그 오프
    }
    savedTime = null; // 스톱워치 시작시간 초기화
    stopTime = 0; // 스톱 당시 시간 초기화
    document.querySelector('h1').innerHTML = '00:00:00.00'; // 화면 표시 시간 초기화
    document.querySelector('#print').innerHTML = ''; // 화면 기록용 초기화
});

// check 버튼
document.querySelector('#check').addEventListener('click', () => {
    const print = document.querySelector('#print'); // 기록 저장용 부모 노드 획득
    const addTag = document.createElement('p'); // 기록 저장용 노드 생성
    addTag.innerHTML = document.querySelector('h1').innerHTML; // 현재 기록 생성 노드에 추가
    
    print.appendChild(addTag); // 기록 저장용 부모 노드에 생성 노드 추가
});