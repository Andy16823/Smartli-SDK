<?php
include_once "inc/usercredentials.php";

define("__API__", "https://smartli.me/api-system/v2/index.php?r=");

function createEndpoint($request) {
    return __API__ . $request;
}

class Smartli
{
    public userCredentials $userCredentials;

    public function __construct(userCredentials $userCredentials)
    {
        $this->userCredentials = $userCredentials;
    }

    private function sendRequest($url, $data)
    {
        $result = false;

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($ch);

        if (!curl_errno($ch)) {
            $result = $response;
        }
        curl_close($ch);

        return $result;
    }

    public function createURL($url)
    {
        $url = bin2hex($url);
        $data = array(
            'app_id' => $this->userCredentials->appId,
            'app_secret' => $this->userCredentials->appSecret,
            'url' => $url
        );

        return $this->sendRequest(createEndpoint('create_url'), $data);
    }

}

?>