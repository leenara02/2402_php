<?php
namespace App\Exceptions;

use Exception;

class MyAuthException extends Exception{
    /**
     * 에러 메세지 리스트
     * 
     * @return Array 에러메세지 배열
     */
    public function context() {
        return [
            'E20' => ['status' => 401, 'msg' => '존재하지 않는 유저'], // 401:권한
            'E21' => ['status' => 401, 'msg' => '비밀번호가 일치하지않음'],
        ];
    }
}