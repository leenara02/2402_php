<?php
namespace controller;

class BoardController extends Controller {
    protected function listGet() { // protected : 상속관계에서만 접근할수있는 접근제어지시자
        return "boardList.php";
    }
}