<?php
// 쿠키삭제
// 쿠키를 삭제하는 키워드는 없지만 쿠키의유효시간을 음수로 변경하면
// 자동을 파기된다.
// 쿠키삭제 : 유효시간을 과거로 다시 셋팅
setcookie("my_cookie2", "쿠키2", time()-100);