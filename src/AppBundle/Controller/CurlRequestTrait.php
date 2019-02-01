<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/25/2019
 * Time: 11:57 AM
 */
namespace AppBundle\Controller;
trait CurlRequestTrait{
    public function getDefaultCurlRequest($url){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => false
        ]);
        curl_exec($curl);
        curl_close($curl);
    }

    public function CustomCurlRequest($url, $method, $item = []){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        if($method == 'post'){
            curl_setopt_array($curl, [
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $item
            ]);
        }elseif ($method == 'put'){
            curl_setopt_array($curl, [
                CURLOPT_CUSTOMREQUEST => "PUT",
                CURLOPT_POSTFIELDS => $item
            ]);
        }elseif ($method == 'delete'){
            curl_setopt_array($curl, [
                CURLOPT_CUSTOMREQUEST => "DELETE"
            ]);
        }

        $response = curl_exec($curl);
        if(!$response) {
            echo curl_error($curl);
        }
        curl_close($curl);
        $result = json_decode($response);

        return $result;

    }
}