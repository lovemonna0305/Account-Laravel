<?php

namespace App\Services\Revoke;

class TwitterRevoke implements ProviderRevoke
{

    public function apply()
    {
        $token = auth()->user()->access_token;
        $client_id = env('TWITTER_CLIENT_ID');

        $request_data = array('client_id' => $client_id, 'token' => $token);
        $request_data_json = json_encode($request_data);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.twitter.com/2/oauth2/revoke?client_id=' . $client_id . '&token=' . $token . '&token_type_hint=access_token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request_data_json);

        $header = array(
            'Content-Type:application/x-www-form-urlencoded'
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        curl_exec($ch);
        $response = curl_getinfo($ch);
        curl_close($ch);
        return $response['http_code'];
    }
}
