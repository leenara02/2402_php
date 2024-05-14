<?php
// 라라벨을 실행하면 처음에 필요한정보를 가져온다. index.php에있는거
// 그 중에 프로바이더가 설정되어있으면 부팅할때 같이 준비해서 실행.
// 이런걸 부트스트래핑 이라고 한다.

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    // 라라벨이 부팅될때 실행된다.
    public function boot()
    {
        //
    }
}
