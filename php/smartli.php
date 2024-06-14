<?php
include_once "inc/usercredentials.php";

/**
 * API Url
 */
define("__API__", "https://smartli.me/api-system/v2/index.php?r=");

/**
 * Creates an api endpoint with the API url and the request
 */
function createEndpoint($request) {
    return __API__ . $request;
}

/**
 * Smartli SDK class to manager the api
 */
class Smartli
{
    /**
     * The user credentials for the api access
     */
    public userCredentials $userCredentials;

    /**
     * Creats an new instance for the sdk
     */
    public function __construct(userCredentials $userCredentials)
    {
        $this->userCredentials = $userCredentials;
    }

    /**
     * Sends an request to the given endpoint with the given data
     */
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

    /**
     * Creat an new shorten url
     */
    public function createURL($url)
    {
        $url = bin2hex($url);
        $data = array(
            'app_id' => $this->userCredentials->appId,
            'app_secret' => $this->userCredentials->appSecret,
            'url' => $url
        );

        $result = $this->sendRequest(createEndpoint('create_url'), $data);
        $result = json_decode($result, true);

        if($result['success'] == true) {
            return $result['data'];
        }
        else {
            return false;
        }
    }

    /**
     * Get the urls from the app user
     */
    public function getUrls() 
    {
        $data = array(
            'app_id' => $this->userCredentials->appId,
            'app_secret' => $this->userCredentials->appSecret,
        );

        $result = $this->sendRequest(createEndpoint('get_urls'), $data);
        $result = json_decode($result, true);

        if($result['success'] == true) {
            return $result['data'];
        }
        else {
            return false;
        }
    }

    /**
     * Edit the url redirection with the given URL ID
     */
    public function editUrl($urlId, $redirectUrl) 
    {
        $data = array(
            'app_id' => $this->userCredentials->appId,
            'app_secret' => $this->userCredentials->appSecret,
            'url_id' => $urlId,
            'redirection_url' => bin2hex($redirectUrl)
        );

        $result = $this->sendRequest(createEndpoint('edit_url'), $data);
        $result = json_decode($result, true);
        
        if($result['success'] == true) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Deletes the given URL
     */
    public function deleteUrl($urlId) {
        $data = array(
            'app_id' => $this->userCredentials->appId,
            'app_secret' => $this->userCredentials->appSecret,
            'url_id' => $urlId
        );

        $result = $this->sendRequest(createEndpoint('delete_url'), $data);
        $result = json_decode($result, true);
        
        if($result['success'] == true) {
            return true;
        }
        else {
            return false;
        }
    }
}

?>