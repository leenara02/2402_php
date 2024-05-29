<?php

namespace App\Http\Controllers;

use App\Exceptions\MyValidateException;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BoardController extends Controller
{
    // 최초 게시글 획득
    public function index(){
        $boardData = Board::select('boards.*', 'users.name')
                            ->join('users','users.id','=', 'boards.user_id') // 연결할 테이블, 컬럼, 부등호, 주 테이블.컬럼 
                            ->orderBy('id', 'DESC')
                            ->limit(20)
                            ->get();
        $responseData = [
            'code' => '0',
            'msg' => '게시글 획득 완료',
            'data' => $boardData->toArray()
        ];

        return response()->json($responseData, 200);
    }

    // 추가 게시글 획득
    public function moreIndex($id) {
        $boardData = Board::select('boards.*','users.name')
                            ->join('users','users.id','=','boards.user_id')
                            ->where('boards.id','<',$id)
                            ->orderBy('boards.id','DESC')->limit(20)->get();
        $responseData = [
            'code' => '0',
            'msg' => '추가 게시글 획득 완료',
            'data' => $boardData->toArray()
        ];

        return response()->json($responseData,200);
    }

    //create-2. 게시글 작성
    public function store(Request $request){

        // 유효성 체크
        $validator = Validator::make(
            $request->only('content', 'img'),
            [
                'content' => ['required','min:1','max:200'],
                'img' => ['required', 'image']
            ]
        );

        // 유효성 검사 실패 체크
        if($validator->fails()){ // 실패했으면 true
            Log::debug('유효성 검사 실패 : ', $validator->errors()->toArray()); //로그의 첫번째 파라미터는 문자열이다
            throw new MyValidateException('E01');
        };

        // 유효성 검사 하고나면 넘어온 데이터를 실제로 저장해야함.

        // 이미지파일 저장
        $path = $request->file('img')->store('img'); // 리퀘스트안에 실제 이미지파일을 우리 이미지파일에 저장한다.

        // ----------------------- 모델을 이용한 인서트 처리
        $boardModel = Board::select('boards.*', 'users.name')
                            ->join('users','users.id','=','boards.id')
                            ->where('users.id', Auth::id())
                            ->first();

        $boardModel->content = $request->content;
        $boardModel->img = $path;
        // 이 게시글 작성한 유저 아이디를 세팅 해줘야함.
        $boardModel->user_id = Auth::id(); // 현재 로그인된 사람의 정보를 가져온다.
        $boardModel->save();
        // 보드 객체로 셀렉트 해왔기 때문에 보드만 업데이트 된다.
        // ------------------------------------------------

        // 레스폰스데이터 만들고 리턴
        $responseData = [
            'code' => '0',
            'msg' => 'board create success',
            'data' => $boardModel->toArray()
        ];
        return response()->json($responseData, 200);
    }
}