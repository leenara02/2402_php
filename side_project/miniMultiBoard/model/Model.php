<?php
namespace model; // 파일이 위치하고있는 패스가 이름이 된다.

// PDO 사용 선언
use PDO;
// 예외처리 사용 선언
// use Throwable; 인터페이스라서 안넣어도 될것같은 느낌.

class Model {
    protected $conn; // PDO객체 저장용 / 상속관계에서 사용할수 있는 접근제어지시자

    // 생성자
    public function __construct(){
        try {
            $opt = [
                PDO::ATTR_EMULATE_PREPARES      => false // DB의 Prepared Statement 기능을 사용하도록 설정
                ,PDO::ATTR_ERRMODE              => PDO::ERRMODE_EXCEPTION // PDO Exception을 Throws하도록 설정
                ,PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC // 연관 배열로 Fetch 설정
            ];

            // PDO 인스턴스
            $this->conn = new PDO(_MARIA_DB_DNS, _MARIA_DB_USER, _MARIA_DB_PW, $opt);
        } catch (\Throwable $th) {
            echo "Model >> __construct(), ".$th->getMessage();
            exit;
        }
    }

    // 트랜젝션 시작
    public function beginTransaction() {
        $this->conn->beginTransaction();
    }

    // 커밋
    public function commit() {
        $this->conn->commit();
    }

    // 롤백
    public function rollBack() {
        $this->conn->rollBack();
    }

    //DB 파기
    public function destroy() {
        $this->conn = null;
    }
}