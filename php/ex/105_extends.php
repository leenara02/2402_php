<?php
// 클래스 상속
// extends
// 상속 : 부모클래스의 자원을 자식클래스가 물려받아 사용하거나 재정의 하는것
// 이중상속은 원칙적으로 불가능하다.(금지)에러낸다.
// 이중상속 : 부모요소가 두개 이상인 경우
// 부모 -> 자식 -> 자식-> 은 가능

class Parents {
    // protected는 보통 프로퍼티로 만듦.
    // 두 자식요소에 중복되는 이름이 있으면 그걸 묶어서 부모요소에 프로텍티드로 만든다.
    protected $name;

    public function __construct(){
        echo "부모 클래스 생성자 실행\n";
    }

    private function home(){
        echo "집은 부모님 겁니다.\n";
    }
    public function car() {
        echo "차는 부모님 자식 다 씁니다.\n";
    }
}
class Child extends Parents {
    public function __construct($name){
        $this->name = $name;
        echo "자식 클래스 생성자 실행\n";
    }

    public function dog() {
        echo "강아지는 제겁니다.\n";
    }

    //오버라이딩 (다형성) : 부모요소의 메소드와 일치하게 만든 후 자식요소에서 재정의 해서 사용
    public function car() {
        echo "이 자동차는 이제 제겁니다.\n";
    }

    public function getName(){
        echo $this->name;
    }
}

$obj = new Child("홍길동");
$obj->car();
$obj->getName();
// 프라이빗은 자식요소에서도 호출이 안된다.
// 자식요소에 construct정의를 먼저 찾고, 정의가 안되어있으면 부모요소의 construct정의를 찾고,
// 부모요소에 construct정의가 있으면 그걸 실행한다.

// 부모요소와 자식요소에 둘다 construct정의가 있는경우
// 부모요소의 construct를 오버라이딩 한것이다. 그래서 자식요소의 construct가 실행됨.