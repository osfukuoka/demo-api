<?php
namespace api;

require('UsersApiService.php');

$usersApiService = new UsersApiService();

if (isset($_GET["id"])) {
    // IDの指定がある場合
    list($statusCode, $res) = $usersApiService->getUser($_GET["id"]);
} else {
    //IDの指定がない場合
    list($statusCode, $res) = $usersApiService->getUserList();
}

// 文字コード設定
header('Content-Type: application/json; charset=UTF-8');

// HTTPステータスコード設定
http_response_code($statusCode);

// レスポンスをJSON形式で返す
print json_encode($res, JSON_PRETTY_PRINT);
?>