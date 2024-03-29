<?php
// try, catch, finally : 보통 트라이캐치문 이라고 한다.
// 예외처리를 할때 필수적으로 사용한다.
// db연결과정에서 에러가나는 경우가 많다.
// 캐치를 여러개 만들어서 if문과 비슷하게 작동하도록 할 수 있다.
// 계층이 낮을수록 위에 작성해야한다.

// finally는 생략가능하다.
try {
    // 예외가 발생할 처리를 작성
    $i = 5 / 0;
echo "\$i의 값은 : ";
echo $i;
}
catch(Throwable $e) {
    // 예외가 발생했을 때 처리를 작성
    echo "예외발생\n".$e->getMessage()."\n"; // 오류매세지출력
}
finally {
    // 예외 발생 여부와 상관없이 무조건 마지막에 실행
    echo "finally \n";
}

echo "계산 완료";

//$i = 5 / 0;
//echo "\$i의 값은 : "; //이스케이프문자 역슬러시 뒤에 오는 한글자는 문자열로 인식함. (변수를 문자열로인식시키기위해)
//echo $i;
// 0으로 나누는건 불가능하기때문에 원래 페이탈에러가 발생함.