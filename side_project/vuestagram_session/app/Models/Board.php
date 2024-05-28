<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     * 갱신 가능한 컬럼 선언
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'content',
        'img',
        'like',
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


}
