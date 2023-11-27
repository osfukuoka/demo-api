<?php
namespace api;

class UsersApiService
{
    private $userList = [
        ["name" => "yamada", "age" => 20],
        ["name" => "suzuki", "age" => 25],
        ["name" => "matsuda", "age" => 30]
    ];
    private $statusCode = 200;
    private $res = [];

    /**
     * ユーザーのリストを取得する
     *
     * @return array httpステータスコード,ユーザーのリスト
     */
    public function getUserList()
    {
        try {
            // 全てのUserリストを返す
            $this->res["status"] = "OK";
            $this->res["users"] = $this->userList;
        } catch (Exception $e) {
            $this->statusCode = 500;
            $this->res["status"] = "NG";
            $this->res["message"] = $e->getMessage();
        }

        return [$this->statusCode, $this->res];
    }

    /**
     * 特定のユーザーを取得する
     *
     * @return array httpステータスコード,ユーザーのリスト
     */
    public function getUser($userId)
    {
        try {
            if ($this->validate($userId)) {
                // IDで指定されたユーザーを返す
                $this->res["status"] = "OK";
                $this->res["users"] = $this->userList[$userId];
            }
        } catch (Exception $e) {
            $this->statusCode = 500;
            $this->res["status"] = "NG";
            $this->res["message"] = $e->getMessage();
        }

        return [$this->statusCode, $this->res];
    }

    /**
     * パラメーターのバリデーション
     *
     * @param int ユーザーID
     * @return boolean バリデーション結果
     */
    private function validate($userId)
    {
        if (preg_match('/[^0-9]/', $userId)) {
            // パラメーターが不正だった場合
            $this->statusCode = 400;
            $this->res["status"] = "NG";
            $this->res["message"] = 'Invalid parameter';
            return false;
        } elseif (!isset($this->userList[$userId])) {
            // 指定されたユーザーが見つからなかった場合
            $this->statusCode = 404;
            $this->res["status"] = "NG";
            $this->res["message"] = 'User not found';
            return false;
        }

        return true;
    }
}
?>