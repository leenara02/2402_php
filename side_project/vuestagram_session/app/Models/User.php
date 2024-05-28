<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * 갱신 가능한 컬럼 선언
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'account',
        'profile',
        'password',
        'name',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * JSON으로 형태를 바꿀때 제외시킬 컬럼 (민감한 정보)
     * 
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'refresh_token',
    ];

    /**
     * TimeZone format when serializing JSON
     * JSON으로 시리얼라이즈 할때, 날짜를 원하는 형식으로 포맷
     * 이 메소드가 없으면 디폴트는 UTC
     * 
     * UTC기준으로 바뀌지 않도록 세팅하는 것
     * 
     * @param \DateTimeInterface $date
     * 
     * @return String('Y-m-d H:i:s')
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * Accessor : 특정 컬럼의 값을 원하는 형태로 가공
     */
    //  함수명 형식 : get컬럼명Attribute
    public function getGenderAttribute($value) {
        return $value == '0' ? '남자' : '여자';
    }   

    // public function boards() {
    //     return $this->hasMany(Board::class); // 1:다 관계에서 다인곳은 hasMany
    // }
}
