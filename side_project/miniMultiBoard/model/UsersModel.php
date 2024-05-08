<?php
namespace model;

class UsersModel extends Model {
    // 특정 유저를 조회하는 메소드
    public function getUserInfo($paramArr) {

        try {
            // 배열이 하나라도 온다는 전제 하에 WHERE을 고정시켜놓은것.
            $sql = " SELECT  * "
            ." FROM users "
            ." WHERE ";
    
            // WHERE 절 동적 생성
            $arrWhere = [];
            // 배열의 키와 값을 돌린다.?
            foreach($paramArr as $key => $val) {
                $arrWhere[] = $key." = :".$key;
            }
    
            // WHERE절 추가
            $sql .= implode(" and ", $arrWhere);
            
            // 데이터 획득
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($paramArr);
            $result =  $stmt->fetchAll();
            return count($result) > 0 ? $result[0] : $result;

        } catch (\Throwable $th) {
            echo "UsersModel >> getUserInfo(), ".$th->getMessage();
            exit;
        }
    }

    // 회원 정보 인서트
    public function addUserInfo($paramArr) {
        try {
            $sql =
            "INSERT INTO users ("
            ." u_email "
            ." ,u_pw "
            ." ,u_name "
            ." ) "
            ." VALUES ( "
            ." :u_email "
            ." ,:u_pw "
            ." ,:u_name "
            ." ) ";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($paramArr);

            return $stmt->rowCount();
        } catch (\Throwable $th) {
            echo "UsersModel >> addUserInfo(), ".$th->getMessage();
            exit;
        }
    }

    // 유저 정보 업데이트
    public function updateUserInfo($paramArr){
        try {
            $sql =
                " UPDATE users "
                ." SET "
                ." u_name = :u_name "
                ." ,u_pw = :u_pw "
                ." ,updated_at = NOW() " // 이걸 적어야지 바보야,ㅠㅠㅠㅠㅠㅠ
                ." WHERE "
                ." u_id = :u_id "
            ;

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($paramArr);
            return $stmt->rowCount();
            
        } catch (\Throwable $th) {
            echo "UserModel >> updateUserInfo(), ".$th->getMessage();
            exit;
        }
    }
}
