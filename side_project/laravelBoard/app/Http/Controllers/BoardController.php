<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 게시글 타입 획득
        $type = 0;
        if($request->has('type')) {
            $type = $request->type;
        }

        // 게시글 조회
        $resultBoardList = Board::where('type', $type)
                            ->orderBy('created_at', 'DESC')
                            ->get();

        // 게시판 이름 조회
        $resultBoardName = BoardName::select('name', 'type')->where('type', $type)->first();
        // get으로 하면 인덱스배열이 하나 더 생기니가 first로.


        
        // if(!Auth::check()) { // 로그인이 안되어있을경우 로그인페이지로 리다렉트
        //     return redirect()->route('get.login');
        // } / 미들웨어를 통해서 중앙처리 함.

        return view('BoardIndex')->with('data', $resultBoardList)->with('boardNameInfo', $resultBoardName);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // 유효성 체크

        // 파일 서버에 저장 : 리퀘스트에있는 파일에 접근, public/img에 파일 저장
        // $filePath = $request->file('file')->store('img');

        // insert 데이터 작성
        $insertData = $request->only('title','content', 'type');
        $insertData['user_id'] = Auth::id();
        // $insertData['img'] = "/".$filePath;
        
        Board::create($insertData);

        return redirect()->route('board.index', ['type' => $request->type]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 게시글 정보 획득
        $resultBoardInfo = Board::find($id); // PK번호로 검색하는 실행 메소드
    
        $responseData = $resultBoardInfo->getOriginal(); // 오리지널에있는 데이터를 배열로 반환
        $responseData['auth_id'] = Auth::id();
        Log::debug('json', $responseData);
        // 예외사항을 로그로 생성해주는 객체.
    
        return response()->json($responseData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Board::destroy($id); // PK를 이용해서 삭제처리하는 메소드 / 삭제한 행 반환
        $responseData = [
            'errorFlg' => false,
            'deletedId' => $id
        ];
        
        return response()->json($responseData);
    }
}
