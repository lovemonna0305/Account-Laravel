<?php

namespace App\Services\Revoke;

class GoogleRevoke implements ProviderRevoke
{

    public function apply()
    {
        $token = auth()->user()->access_token;
        $ch = curl_init("https://oauth2.googleapis.com/revoke?token={$token}");
        $header = array(
            'Content-Type:application/x-www-form-urlencoded'
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        $resultdata = curl_exec($ch);
        $response = curl_getinfo($ch);
        curl_close($ch);
        return $response['http_code'];
    }
}
