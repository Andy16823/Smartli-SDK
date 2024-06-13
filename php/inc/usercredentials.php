<?php

class userCredentials
{
    public String $appId;
    public String $appSecret;

    public function __construct(String $appId, String $appSecret)
    {
        $this->appId = $appId;
        $this->$appSecret = $appSecret;
    }
}
