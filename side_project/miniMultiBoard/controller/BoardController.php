<?php
namespace controller;

use model\BoardsModel;

class BoardController extends Controller {
    protected $arrBoardList = []; // 게시글 정보 리스트
    private $boardType = "0"; // 보드타입

    // boardType getter (캡슐화)
    public function getBoardType() {
        return $this->boardType;
    }
    // boardType setter (캡슐화)
    public function setBoardType($boardType) {
        $this->boardType = $boardType;
    }

    //게시글 리스트
    protected function listGet() { // protected : 상속관계에서만 접근할수있는 접근제어지시자
        // 보드타입 확인
        $requestData = [
            "b_type" => isset($_GET["b_type"]) ? $_GET["b_type"] : "0"
        ];
        // $b_type = isset($_GET["b_type"]) ? $_GET["b_type"] : "0";

        // 보드타입 프로퍼티 셋
        $this->setBoardType($requestData["b_type"]);
        
        // TODO : 유효성 체크는 시간남으면 도전해보세요.

        // 페이지 제목
        foreach($this->arrBoardsNameInfo as $item) {
            if($item["b_type"] === $requestData["b_type"]) {
                $this->boardName = $item["bn_name"];
                break;
            }
        }

        // 게시글 정보 획득
        $modelBoards = new BoardsModel();
        $this->arrBoardList = $modelBoards->getBoardList($requestData);

        // 사용한 모델 파기
        $modelBoards->destroy();

        return "boardList.php";
    }

    // 게시글 작성
    public function addPost() {
        // 이미지 파일 패스 처리
        $path = "/"._PATH_IMG.$_FILES["img"]["name"];
        move_uploaded_file($_FILES["img"]["tmp_name"], _ROOT.$path);

        $requestData = [
            "b_type"        => $_POST["b_type"]
            ,"b_title"      => $_POST["b_title"]
            ,"b_content"    => $_POST["b_content"]
            ,"b_img"        => $path
            ,"u_id"         => $_SESSION["u_id"]
        ];

        // 글작성 처리
        $modelBoards = new BoardsModel();
        $modelBoards->beginTransaction(); // 트랜젝션 시작
        // $resultAddBoard = $modelBoards->addBoard($requestData);
        if($modelBoards->addBoard($requestData) === 1) {
            $modelBoards->commit();
        } else {
            $modelBoards->rollBack();
        }

        return "Location: /board/list?b_type=".$requestData["b_type"];
    }

    // 상세 정보 조회  : JSON 방식으로 보내준다.
    public function detailGet() {
        
        $requestData = [
            "b_id" => $_GET["b_id"]
        ];

        // 게시글 정보 조회
        $modelBoards = new BoardsModel();
        $resultBoard = $modelBoards->getBoard($requestData);

        // JSON 변환
        // 배열을 json으로 변환 해주는 함수
        $response = json_encode($resultBoard);

        // response 처리
        header('Content-type: application/json');
        echo $response; // 제이슨데이터를 출력
        exit;
    }
}