<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/30/2019
 * Time: 11:41 AM
 */

namespace AppBundle\Controller;
use Symfony\Component\Routing\Annotation\Route;


class Game
{
    var $price;
    var $name;
    var $photo;
    var $dir = 'games/';
    const BR= '<br />';

    /**
     * @Route("class")
     */
    public function print_game(){
        echo $this->name.self::BR;
        echo $this->price.self::BR;
        echo $this->dir.$this->photo;
    }

    public function set_game($name,$price,$photo){
        $this->name = $name ;
        $this->price= $price;
        $this->photo= $photo;
    }

}

$game = new Game();
//$game->name = 'Bio';
//$game->price = 14.99;
//$game->photo ='photo.jpg';
//
//$game->print_game();
//
//$game->name = 'The witch 3';
//$game->price = 27.89;
//$game->print_game();
//
$game->set_game('Ovcer noght',44.99,'over.jpg');
$game->print_game();