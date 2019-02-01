<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/24/2019
 * Time: 3:41 PM
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CurlController extends Controller
{
    use CurlRequestTrait;
    /**
     * @Route("curl/request-data/{url}",name="fetch_data")
     * @param String $url
     */
    public function fetchAction($url){

         $this->getDefaultCurlRequest($url);
    }

    /**
     * @Route("search-url",name="search_curl")
     * @param Request $request
     * @return Response
     */
    public function parseFormAction(Request $request) {
        $request_url= "";
        $form = $this->createForm(UrlForm::class, null,[
            'method'=> 'post',
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() && (!empty($url= $form->getData()['url']))) {
            $request_url = $this->getDefaultCurlRequest($url);
        }
        return $this->render('@App/curl/curl-url-form.html.twig',[
            'search_url' =>$form->createView(),
            'url' =>$request_url
        ]);
    }

    /**
     * @Route("get-photos-url", name="photos_url")
     */
    public function getImgAction( ){
        //https://i.ytimg.com/vi/7H2GbAe0pz4/hqdefault.jpg
        $curl = curl_init();
        $url = "https://www.youtube.com/channel/UC4CxFL4M5brlVigBH_1VTPQ/videos?disable_polymer=1";
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true
        ]);
        $result = curl_exec($curl);

        preg_match_all('!https://i.ytimg.com/vi/[^\s]*?/hqdefault.jpg!',$result, $matches);
        $img = array_values(array_unique($matches[0]));
        for($i=0;$i<count($img);$i++){
            $img[$i];
        }

        $preg = preg_match_all('href="watch(.*?)"',$result, $matches);

        $link = array_values(array_unique($matches[0]));

        curl_close($curl);
        print_r($preg);
        return $this->render('@App/curl/img-curl-url.html.twig',[
            'images' => $img,
            'links'  => $link
        ]);

    }


}