<?php
// 토큰 생성 체크 저장
namespace App\Utils;

use App\Exceptions\MyAuthException;
use MyEncrypt;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PDOException;

class MyToken {

    /**
     * 엑세스, 리프레쉬 토큰 생성
     * 
     * @param   App\Models\User $userInfo
     * 
     * @return  Array [$accessToken, $refreshToken]
     */
    public function createTokens(User $userInfo) {
        $accessToken = $this->createToken($userInfo, env('TOKEN_EXP_ACCESS'));
        $refreshToken = $this->createToken($userInfo, env('TOKEN_EXP_REFRESH'), false); // 일회용 (엑세스토큰을 재발급하기 위한 토큰)

        return [$accessToken, $refreshToken];
    }

    /**
     * JWT 생성
     * 
     * @param App\Models\User $userInfo
     * @param int $ttl
     * @param bool $accessFlg = true
     * 
     * @return string JWT
     */
    private function createToken(User $userInfo, int $ttl, bool $accessFlg = true) {
        $header = $this->makeHeader();
        $payload = $this->makePayload($userInfo, $ttl, $accessFlg);
        $signature = $this->makeSignature($header, $payload);

        return $header.".".$payload.".".$signature;
    }

    /**
     * JWT 헤더 작성
     * 
     * @return string base64Header
     */
    private function makeHeader() {
        $header = [
            'alg' => env('TOKEN_ALG'),
            'typ' => env('TOKEN_TYPE')
        ];

        return MyEncrypt::base64UrlEncode(json_encode($header));
    }

    /**
     * JWT 페이로드 작성
     * 
     * @param   App\Modal\User $userInfo
     * @param   int $ttl(초단위)
     * @param   bool $accessFlg
     * 
     * @return  string base64Payload
     */
    private function makePayload(User $userInfo, int $ttl, bool $accessFlg) {
        $now = time(); // 현재시간

        // 페이로드 기본 데이터 생성
        $payload = [
            'idt' => $userInfo->id, // 아이덴티티
            'iat' => $now, // 이슈드 어 토큰
            'exp' => $now + $ttl,
            'ttl' => $ttl
        ];

        // 액세스 토큰일 경우 아래 데이터 추가
        if($accessFlg) {
            $payload['acc'] = $userInfo->account;
            $payload['name'] = $userInfo->name;
        }

        return MyEncrypt::base64UrlEncode(json_encode($payload));
    }

    /**
     * JWT 시그니처 작성
     * 
     * @param string $header base64 URL Encode
     * @param string $payload base64 URL Encode
     * 
     * @return string base64Signature
     */
    private function makeSignature(string $header, string $payload) {
        
        return MyEncrypt::hashWithSalt(env('TOKEN_ALG'),$header.env('TOKEN_SECRET_KEY').$payload, MyEncrypt::makeSalt(env('TOKEN_SALT_LENGTH'))); // 랜덤한문자열을 넣는걸 salt라고한다.
    }

    /**
     * 리프레시 토큰 저장
     * 
     * @param App\Model\User $userInfo 유저정보
     * @param string $refreshToken 리프레시 토큰
     * 
     * @return bool true
     */
    public function updateRefreshToken(User $userInfo, string $refreshToken){
        // 유저 모델 객체에 리프레시 토큰 추가
        //          컬럼명
        $userInfo->refresh_token = $refreshToken;

        // update 처리 (try catch 안하고 핸들러에서 관리.) 
        DB::beginTransaction();

        if(!($userInfo->save())) {
            DB::rollBack();
            throw new PDOException();
        }
        DB::commit();

        return true;
    }
}

