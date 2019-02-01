<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/22/2018
 * Time: 6:12 PM
 */
namespace AppBundle\Controller;


trait PutRequestTrait
{
    public function getRequestUrl($url){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        if(!$result) {

            echo curl_error($ch);
        }
        curl_close($ch);
        $countries  = json_decode($result);
        return $countries;
    }

    public function getCustomRequestUrl ($url,$methods,$data = []){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if($methods=='post'){
            curl_setopt ($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }elseif($methods=='put'){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        }elseif($methods=='delete'){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }

        $response = curl_exec($ch);
        if(!$response) {

            echo curl_error($ch);
        }
        curl_close($ch);
        $response = json_decode($response);
        return $response;
    }
}