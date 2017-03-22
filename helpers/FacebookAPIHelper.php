<?php

namespace app\helpers;

/**
 * Description of FacebookAPIHelper
 *
 * @author original
 */
class FacebookAPIHelper
{
    public static function call($endpoint, array $data)
    {
        $url = 'https://graph.facebook.com/v2.6/' . $endpoint;
        $data['access_token'] = $this->token;
        $headers = [
            'Content-Type: application/json',
        ];
        $ch = curl_init($url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $return = curl_exec($ch);
        curl_close($ch);
        return json_decode($return, true);
    }
}
