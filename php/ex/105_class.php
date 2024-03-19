<?php
// class : 동종의 객체들을 모아 정의한 것
// 관습적으로 클래스명과 파일명을 동일하게 지어준다.
// 중괄호 안을 멤버필드 라고한다.
class Whale {
    //프로퍼티
    // 접근 제어 지시자
    //public     : class 외부, 내부 어디서나 접근 가능 (프로퍼티로는 잘 사용 x)
    public $str; 
    //private    : class 내부에서만 접근 가능, 외부는 접근 불가능
    private $i;
    //protected  : class 내부에서만 접근 가능, 외부는 접근 불가능 / 단, 상속관계에서는 접근가능
    protected $boo;

    //프로퍼티는 데이터를 보호하기위해서 퍼블릭은 거의 사용하지 않는다.
    // 고래 라는 문자열을 파라미터에 저장할려고 만든 프로퍼티
    private $name;

    // 생성자(생성자메소드)(construct)
    // 무조건 퍼블릭으로 해야됨
    // 메소드명 고정되어있음.
    // $this-> 는 내 클래스에 있는 프로퍼티를 사용하기위한것
    public function __construct($name){
        $this->name = $name;
    } // 파라미터 값 저장용 메소드

    // getter / setter : private이나 protected로 설정된 프로퍼티에 접근을 위해 사용하는 메소드
    // 외부에서 접근불가능한경우 프로퍼티값을 가져오고싶을때
    public function getName() {
        return $this->name;
    } // getter메소드
    public function setName($name) {
        $this->name = $name;
    } // setter메소드

    // 메소드 : 클래스 안에 있는 함수
    public function swim($opt){
        echo $opt.$this->name." 헤엄칩니다.\n";
    } // 출력을 담당하는 메소드
    public function breathe() {
        echo $this->name." 호흡 한다.\n";
    }

    // static 메소드 : 인스턴스 생성 없이 사용할수 있는 메소드
    // static메소드를 미리 메모리에 올려두기 때문에 인스턴스없이사용할수있음
    // static은 엄청자주 사용하는곳에선 올려둬도 되지만 왠만하면 안쓰는게좋음. 용량때문에
    // static에서는 $this->를 쓸수없다.
    // 유틸쪽(암호화하는처리)에 많다.
    public static function big() {
        echo "매우크다. ";
    }
}

// shark 클래스를 만들어주세요.
// 프로퍼티 : private $name
// 메소드 : public swim, public breathe
class Shark {
    private $name;
    public function __construct($name){
        $this->name = $name; // 생성자
    }
    public function swim(){
        echo $this->name."헤엄칩니다\n";
    }
    public function breathe($opt){
        echo $this->name.$opt."호흡한다.\n";
    }
}
$objShark = new Shark("상어 "); // 인스턴스 생성
$objShark->swim(); // 메소드 호출
$objShark->breathe("아가미 "); // 메소드에 아규먼트 삽입

// 클래스 인스턴스 : class를 사용하기위해 메모리에 올리는것
// 클래스 인스턴트 생성
// $obj_whale = new Whale("고래"); // 인스턴스 생성
// $obj_whale->swim("흰 수염 "); // 메소드 호출 (인스턴스변수->메소드명()), 관습적으로 띄어쓰기 하지않음.(연결관계파악)
// echo $obj_whale->getName()."\n";
// $obj_whale->breathe();

// $obj_whale->setName("참새");
// $obj_whale->swim("흰 수염 ");
// $obj_whale->breathe();
// 클래스 외부에서도 메소드를 사용할수있는 이유는 퍼블릭이기 때문에
// 프라이빗이나 프로텍티드는 외부에서 실행할수없음.

// 글로벌 스코프 : 중괄호로 쌓여져있는 곳은 블럭영역, 그외가 전역(글로벌스코프)
// 클래스를 파일따로 생성하고 인클루드로 불러와서 사용하는경우도있다.
// php에서 객체지향을 쓴다하면 프레임워크를 쓴다
// 객체지향은 내가 호출한 순서대로 실행된다.

// 인스턴스 생성 -> 콘스트럭트 생성 -> 인스턴스 아규먼트가 콘스트럭트 파라미터에 저장
// 콘스트럭트 실행 -> 메소드호출 -> 메소드실행 (에코출력)

// 인스턴스생성과 메소드호출 확실하게 알고가쟝

// 호출한 순서대로 어떻게 작동되는지 F5번 누르기 전에 한번 생각하고 실행해보자
// 모듈화 시켜두고 디자인 하는게 객체지향이다

// static메소드 호출
Whale::big();
// 아~ 스태틱 쓰는거구나 ,,,
// 어쩌구->어쩌구
// 아~ 스태틱안쓰고있구나,,,
