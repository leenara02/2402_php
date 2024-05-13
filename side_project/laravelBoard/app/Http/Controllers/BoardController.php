<?php

namespace App\Http\Controllers;

use App\Models\Board;
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

        return view('boardIndex')->with('data', $resultBoardList);


        // if(!Auth::check()) { // 로그인이 안되어있을경우 로그인페이지로 리다렉트
        //     return redirect()->route('get.login');
        // } / 미들웨어를 통해서 중앙처리 함.
        return view('BoardIndex');
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
        // var_dump($request->all());
        // $request->file('file')->store('img', 'public');
        // TODO : 파일 업로드 처리
        $insertData = $request->only('title','content', 'type');
        $insertData['user_id'] = Auth::id();
        $insertData['img'] = '/img/sum01.png'; // TODO : 나중에 수정

        $resultInsert = Board::create($insertData);

        return redirect()->route('board.index');
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
        //
    }
}
