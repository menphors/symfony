<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/1/2019
 * Time: 4:12 PM
 */

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
require_once $_SERVER['DOCUMENT_ROOT']. "/share/matrix/matrix.txt";

class Movie extends Controller{
    const BR = '<br />';
    /**
     * @Route("datatype")
     */
    public function datatypeAction(){

        $name = 'The matrix';
        $release_year = 1999;
        $cost_now = 8.99;
        $awsome = true;
        $cast = array('kean Reeves' => 'Neo','Laurence Fishburne'=> 'Morpheus',
            'Carrie-Anne Moss'=> 'Trinity','Hugo Weaving'=> 'Agent Smith');//array
        $matrix = new Movie();
        $nothing = NULL;
        $open = fopen( $_SERVER['DOCUMENT_ROOT']."/share/matrix/matrix.txt","r");//resource

        $data = array($name,$release_year,$cost_now,$awsome,$cast,$matrix,$open);

        for($i =0 ; $i <count($data); $i++){
            echo gettype($data[$i]);

            if(is_array($data[$i])){
                print_r($data[$i]);
            }

            if(is_numeric($data[$i])){
                echo 'Numeric value detected'.$data[$i].self::BR;
            }
        }
    }
}
