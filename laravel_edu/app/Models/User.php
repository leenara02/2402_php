<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // 해당 모델에 소프트딜리트를 적용시키고 싶으면 softDeleted 트레이드 추가
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes; //트레이트? 호출,인스턴스하지않고 트레이트하면 다른모듈에있는걸 사용할 수 있음.

    // 모델과 이어질 테이블 명을 정의하는 프로퍼티
    // protected $table = 'users'; // 모델명이 User 일경우 자동으로 테이블명을 users로 인식

    // PK를 지정하는 프로퍼티
    // protected $primaryKey = 'id'; // users에 id 컬럼을 PK 로 지정




    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    // !!!! 화이트리스트, 블랙리스트 중 하나만 쓰면 된다 !!!!
    // upsert시 변경을 허용할 컬럼들 설정하는 프로퍼티(화이트리스트)
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
    ];
    // upsert시 변경을 비허용할 컬럼들 설정하는 프로퍼티(블랙리스트)
    // protected $guarded = [
    //     'id'
    // ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

}
