<?php

namespace App\Services\Revoke;

use GuzzleHttp\Client;

class FacebookRevoke implements ProviderRevoke
{

    public function apply()
    {
        $token = auth()->user()->access_token;
        $http = new Client();
        $response = $http->delete("https://graph.facebook.com/v3.0/".auth()->user()->provider_id."/permissions?access_token={$token}");
        return $response->getStatusCode();
    }
}