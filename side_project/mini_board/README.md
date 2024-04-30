모든 폴더 및 파일 카피하는 방법

xcopy 원본경로 카피경로 /E /Y

예) 
xcopy D:\workspace\2402_php\side_project\mini_board\src C:\Apache24\htdocs /E /Y


$btn_page_cnt = 5; //한페이지에 나타낼 게시물 수
$max_page_num = 최대 페이지 수 (식 구해야 함)
$now_page = 현재 페이지 (식 구해야함)

$start_page = ceil($now_page / $btn_page_cnt) * $btm_page_cnt - ($bt_page_cnt -1);
$end_page = $start_page + ($btn_page_cnt -1);
$end_page = $end_page > $max_page_num ? $max_page_num : $end_page;

for($i = $start_page; $i <= $end_page; $i++) {
    echo "$i page\n";
}