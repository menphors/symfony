<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/1/2019
 * Time: 3:23 PM
 */

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
class SessionController extends Controller
{
    /**
     * @Route("session")
     */
    public function sessionAction(){
        //session_start();
        //$session global variable array
        $_SESSION['username'] = 'clever';
        $_SESSION['role'] = 'admin';
        return $this->pre_r($_SESSION);
    }
    public function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
    /**
     * @Route("switch")
     */
    public function switchAction(){
        //switch case break
        $animal = array('cat','dog','duck','monster');
        switch ($animal[array_rand($animal)]){
            case 'cat': return  'Meow';
            break;
            case 'dog':
                return 'Waow';
            break;
            case 'duck': return 'Quack!';
            break;
            default: return 'Non all of them';

        }
    }

    /**
     * @Route("switch-group")
     */
    public function switchGroupAction(){
        $specise = array('cat','dog','cow','fly','bee','ant');
        switch ($specise[array_rand($specise)]):
            case 'cat':
            case 'dog':
            case 'cow':
                echo 'We are animals';
            case 'fly':
            case 'bee':
            case 'ant':
                echo 'We are insects!';
            break;
        endswitch;
    }

    /**
     * @Route("if-statement")
     */
    public function ifAction(){
        $answer = 42;
        $truth = 1;
        if($answer == 42){
            echo 'The ultimate answer 42<br />';
            if($truth){//boolean
                echo 'You speak true';
            }
        }elseif ($answer == 13){
            echo 'today is lucky day';
        } else{
            echo 'You dont have figured out yet! Keep trying';
        }

        $ok= false;
        $message = $ok?"Yes I ok": "Leave me alone";

        echo $message;
    }
    /**
     * @Route("foreach-loop")
     */
    public function arrayLoopAction(){
        $animals = [
            'antelop'=> 'snot',
            'Bear'=> 'screebssh',
            'Dolphin'=> 'Clicks',
            'Goose'=>'Hook',
            'Vulture'=> 'Screams'
        ];

        foreach ($animals as $name =>$value){
            echo $name.' '.$value.'<br />';
            echo 'Key :'.$animals[$name].'<br />';
        }
        //modify array by reference

        $number = array(1,2,3,4,5);
        print_r($number);
        foreach ($number as &$number){
            $number = $number * 2;
        }

        echo '<br />';
        unset($number);//break the reference with last element
    }
}