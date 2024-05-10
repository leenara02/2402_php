<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function eduUser() {
        // --------------------------------
        // 쿼리 빌더 : 문자열은 홑따옴표!! / 보통은 평문을 쓰지않고 엘리퀀트를 사용함.
        // --------------------------------
        // SELECT --------------------------------------------------
        // $result = DB::select('select * from users');

        // $result = DB::select(
        //     "select * from users where name = :name"
        //     ,['name'=>'갑돌이']
        // ); 
        
        // $result = DB::select(
        //     "select * from users where name = ? or name = ?"
        //     ,['갑돌이', '갑순이']
        // );
        
        // 탈퇴한 회원을 조회
        // $result = DB::select(
        //     "select * from users where deleted_at IS NOT NULL"
        // );
        
        // INSERT --------------------------------------------------
        // $sql = 'INSERT INTO users(name, email, password) VALUES(?, ?, ?)';
        // $data = ['김철수', 'admin4@admin.com', Hash::make('qwer1234!')];
        // DB::beginTransaction(); // 트랜젝션 시작
        // $result = DB::insert($sql, $data); // (쿼리문, PreparedStatement)
        // if(!$result) {
        //     DB::rollBack(); // 롤백
        // } else {
        //     DB::commit(); // 커밋
        // }

        // update --------------------------------------------------
        // $sql = 'UPDATE users SET deleted_at = NULL WHERE id = ?';
        // $data = [5];
        // $result = DB::update($sql, $data);
        // 업데이트는 결과가 영향받은행 int로 온다.

        // delete --------------------------------------------------
        // $sql = 'DELETE FROM users WHERE id=?';
        // $data = [7];
        // $result = DB::delete($sql, $data);

        // --------------------------------
        // 쿼리 빌더 체이닝 / 기본적으로 값들에 대한 PreparedStatement가 지정된다.
        // --------------------------------

        // SELECT --------------------------------------------------
        
        // users 테이블 모든 데이터 조회
        // select * from users;
        $result = DB::table('users')->get();
        
        // 자동으로 PreparedStatement로 지정된다.
        // select * from users where name = ?; ['홍길동']
        $result = DB::table('users')->where('name', '=', '홍길동')->get(); // 컬럼,연산자,값
        
        // select * from users where id = ? or id = ?; [3, 4]
        // (=) 부등호는 생략이 가능하다.
        $result = DB::table('users')->where('id', '3')->orWhere('id',4)->get();
        
        // select * from users where name = '홍길동' and id = 3; ['홍길동', 3]
        $result = DB::table('users')->where('name', '홍길동')->where('id', 4)->get();
        
        // select name from users order by name ASC;
        $result = DB::table('users')->select('name')->orderBy('name', 'asc')->get();
        
        // select * from users where id in(?, ?); [2,5]
        $result = DB::table('users')->whereIn('id', [2, 5])->get();

        // select * from users where deleted_at IS NULL;
        $result = DB::table('users')->whereNull('deleted_at')->get();

        // 2023년에 가입한 사람만 출력
        // select * from users where year(created_at) = ? // 속도이슈가 있으면 아래방식 사용
        // select * from users where created_at between 20230101000000 and 20231231235959
        $result = DB::table('users')->whereYear('created_at', '2023')->get();

        // 성별 회원수를 구하자 (남자회원수 구하기 위해서 having절 추가)
        // select gender, count(gender) from users group by gender;
        // 집계함수 쓰려면 select 안에 DB::raw('집계함수() as 별칭') 쓰면됨.
        $result = DB::table('users')
                ->select('gender', DB::raw('COUNT(gender) cnt'))
                ->groupBy('gender')->having('gender', '=', 'M')->get();
        
        //select id, name from users order vy id limit ? offset 2; [1, 2]
        $result = DB::table('users')
                ->select('id', 'name')->orderBy('id') // ASC가 디폴트
                ->limit(1)->offset(2)->get();

        // conditional - where 절 (동적쿼리, 넘어온데이터가 있으면 where절 생성, 없으면 x)
        $reqData = 1; // 유저가 1또는 빈값인 데이터 전달
        $result = DB::table('users')
                ->when($reqData, function($query, $reqData) { // $query : when이 실행되기 전의 쿼리 DB::table('users')
                    $query->where('id', $reqData);
                })->get();

        // 실행 메소드 ----------------------------------------------
        // first() : 쿼리 결과에서 가장 첫번재 레코드만 반환
        $result = DB::table('users')->first();
        
        // count() : 쿼리 결과의 레코드 수를 반환
        $result = DB::table('users')->count();

        // find($id) : 지정된 기본키에 해당하는 레코드를 반환
        $result = DB::table('users')->find(3); // users에서 PK가 3인 데이터를 반환

        // INSERT --------------------------------------------------
        // $result = DB::table('users')->insert([
        //     'name' => '김영희'
        //     ,'email' => 'kim@admin.com'
        //     ,'password' => Hash::make('qwer1234!')
        //     ,'gender' => 'F'
        // ]);

        // UPDATE --------------------------------------------------
        // $result = DB::table('users')->where('id',8)->update(['email'=>'kim@naver.com']);

        // DELETE --------------------------------------------------
        // $result = DB::table('users')->where('id', 8)->delete();

        // --------------------------------
        // Eloquent Model 
        // --------------------------------
        // $result = User::find(3);
        $result = User::all(); // 필요한정보 가져올땐 [방번호]->컬럼명으로 가져온다.

        // upsert : 업데이트 할게 있으면 업데이트, 없으면 추가
        // 원래는 DB::beginTransaction() 해줘야함!
        // insert
        $data = [
            'name' => '김영희',
            'email' => 'kim@naver.com',
            'password' => Hash::make('qwer1234!'),
            'gender' => 'F'
        ];
        // $result = User::create($data);

        // update
        // DB::beginTransaction(); // 트랜젝션시작하고 커밋이 안된다면 자동으로 롤백해줌
        // $target = User::find(10);
        // $target->gender = 'M';
        // $result = $target->save(); // bool로 나온다.
        // DB::commit();

        // delete : softDelete 트레이트를 했기때문에 deleted_at가 NOT NULL 로 바뀐다.
        // $result = User::destroy(10);

        // 소프트 딜리트 된 데이터 조회
        $result = User::withTrashed()->get(); // 소프트딜리트 포함
        $result = User::onlyTrashed()->get(); // 소프트딜리트 만

        // 소프트 딜리트 된 데이터 복원
        $result = User::where('id', 10)->restore();

        // 

        return var_dump($result);
    }
}
