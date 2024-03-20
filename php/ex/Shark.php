<?php
// namespace : 해당 파일의 주소를 할당
// 일반적으로 해당파일의 패스를 적어준다.
// 패스 (경로)
namespace php\ex;
class Shark {
    private $name;

    // 생성자
    public function __construct($name) {
        $this->name = $name;
    }

    // 메소드
    
    /**
     * name + 호흡합니다 출력
     */
    public function swim() {
        echo $this->name." 헤엄 칩니다.\n";
    }

    public function breathe() {
        echo $this->name." 호흡 합니다.\n";
    }
}