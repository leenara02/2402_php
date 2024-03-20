<?php
class Whale {
    // 프로퍼티
    // 접근 제어 지시자
    // public : class 외부, 내부 어디에서 접근 가능
    public $str;
    // private : class 내부에서만 접근 가능, 외부는 접근 불가능
    private $i;
    // protected : class 내에서만 접근 가능, 외부에서는 접근 불가능, 단, 상속관계에서는 접근이 가능
    protected $boo;

    private $name;

    // 생성자 메소드
    public function __construct($name) {
        $this->name = $name;
    }

    // getter / setter : private이나 protected로 설정된 프로퍼티에 접근을 위해 사용하는 메소드
    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }

    // 메소드
    public function swim($opt) {
        echo $opt.$this->name." 헤엄 칩니다.\n";
    }
    public function breathe() {
        echo $this->name." 호흡 한다.\n";
    }
}