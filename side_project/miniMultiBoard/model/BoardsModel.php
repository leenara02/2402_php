<?php
namespace model;

class BoardsModel extends Model {
    public function getBoardList(array $paramArr) {
        try {
            $sql =
            " SELECT "
            ." b_id "
            ." ,b_title "
            ." ,b_content "
            ." ,b_img "
            ." FROM "
            ." boards "
            ." WHERE "
            ." b_type = :b_type "
            ." ORDER BY "
            ." b_id DESC "
            ;

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($paramArr);
            $result = $stmt->fetchAll();

            return $result;

        } catch (\Throwable $th) {
            // 현업에서는 에러메세지를 콘솔파일에 몰아놓고 에러메세지를 띄우고 처리는 계속하도록 만든다.
            echo "BoardsModel -> getBoardList, ".$th->getMessage();
            exit;
        }
    }

    public function addBoard($paramArr) {
        try {
            $sql =
                " INSERT INTO boards( "
                ." u_id "
                ." ,b_type  "
                ." ,b_title "
                ." ,b_content "
                ." ,b_img "
                ." ) "
                ." VALUES( "
                ." :u_id "
                ." ,:b_type  "
                ." ,:b_title "
                ." ,:b_content "
                ." ,:b_img "
                ." ) "
            ;

                $stmt = $this->conn->prepare($sql);
                $stmt->execute($paramArr);
                return $stmt->rowCount(); // 1이 아니면 이상.
            } catch (\Throwable $th) {
                echo "BoardsModel >> addBoard(), ".$th->getMessage();
                exit;
            }
    }

    // 게시글 조회
    public function getBoard($paramArr){
        try {
            $sql =
                " SELECT "
                .  " b_id "
                .  " ,b_title "
                .  " ,b_content "
                .  " ,b_img "
                .  " ,u_id "
                .  " FROM "
                .  " boards "
                ." WHERE "
                .  " b_id = :b_id "
            ;

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($paramArr);
            $result = $stmt->fetchAll();
            return $result;

        } catch (\Throwable $th) {
            echo "BoardsModel >> getBoard(), ".$th->getMessage();
            exit; // exit뒤에 괄호 있는게 정석인데 보통 생략해서 작성함.
        }
    }
}