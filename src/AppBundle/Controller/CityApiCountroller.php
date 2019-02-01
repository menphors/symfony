<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/25/2018
 * Time: 10:08 AM
 */
namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CityApiCountroller extends Controller
{
    use PutRequestTrait;
    /**
     * @Route("/rest/cities/list/{countryId}", name="city_list")
     * @param int $countryId
     * @param Request $request
     * @return Response
     */
    public function CityListAction(Request $request,$countryId=null){
        $form      = $this->createForm(SearchForm::class, ['countryId'=>$countryId], [
            'method'=> 'GET',
            'action'=> $this->generateUrl('city_list')
        ]);
        $form->handleRequest($request);

        if(($form->isSubmitted() && $form->isValid()) && (!empty($name = $form->getData()['name']))){
            $urlCityName = "http://192.168.56.51:8000/rest/cities?&name=".urlencode($name);
            $cities = $this->getRequestUrl($urlCityName);
            $data = $form->getData();

            $countryInfo = [];
            foreach ( $cities as $city) {
                if($city->country->id == $data['countryId']){
                    $countryInfo[] = $city;
                }
            }
            return $this->render('@App/xml/cities-search.html.twig',[
                'country_info'=>$countryInfo,
                'search_city' =>$form->createView(),
            ]);
            //var_dump($searchCity);exit;
        }else{
            $urlCountry     = "http://192.168.56.51:8000/rest/country/".$countryId;
            $countryInfo    = $this->getRequestUrl($urlCountry);
        }


        return $this->render('@App/xml/cities-list.html.twig',[
            'country_info'=>$countryInfo,
            'search_city' =>$form->createView(),
            'countryId' => $countryId
        ]);
    }

    /**
     * @Route("rest/city/{cityId}", name="update_city")
     * @param int $cityId
     * @param Request $request
     * @return Response
     */
    public function updateCityIdAction(Request $request,$cityId = null){
        $id = $request->get('countryId');
        $urlCity = "http://192.168.56.51:8000/rest/city/".$cityId;
        $cities  = $this->getRequestUrl($urlCity);

        if($cities) {
            $city['id'] = $cities->id;
            $city['name'] = $cities->name;
            $city['isoCode'] = $cities->isoCode;
            $city['geoLocation'] = $cities->geoLocation;
            $city['countryId'] = $cities->country->id;
        }
        $form = $this->createForm(CityForm::class,empty($city)? null:$city,[
            'method' =>'POST',
            'action' =>$this->generateUrl('update_city',
                ['id'=>$cityId])
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $data               = $form->getData();
            $data_arr           = http_build_query([
                "name"          => $data['name'],
                "geoLocation"   => $data['geoLocation'],
                "isoCode"       =>$data['isoCode'],
                "countryId"     =>$data['countryId']
            ]);

            $found = $this->getCustomRequestUrl("$urlCity{$data['id']}","put",$data_arr);
            if($found){

                return $this->redirect('/rest/cities/list/'.$data['countryId']);

            }
        }
        return $this->render('@App/xml/cities-update.html.twig',[
            'form_city_update'=>$form->createView()
        ]);
    }
    /**
     * @Route("/rest/cities/{countryId}/{id}/delete/", name="delete_city")
     * @param int $id
     * @param int $countryId
     * @return Response
     */
    public function deleteCityAction($id, $countryId){

        if ($id){

            $url         = "http://192.168.56.51:8000/rest/city/". urlencode($id);
            $delete_city = $this->getCustomRequestUrl($url,'delete');
            if($delete_city){
                $this->addFlash('error_city', 'You deleted city Successfully!');
            }

        }else{
            $this->addFlash('error_city', 'ID of city wasn\'t correct !');
        }
        return $this->redirect('/rest/cities/list/'.$countryId);
    }
    /**
     * @Route("rest/city/create", name="create_city")
     * @param Request $request
     * @param int $countryId
     * @return Response
     */
    public function createCityAction(Request $request,$countryId){
        $urlCountry     = "http://192.168.56.51:8000/rest/country/".$countryId;
        $countryInfo    = $this->getRequestUrl($urlCountry);
        var_dump($countryInfo);
        exit();
        $form   = $this->createForm(CityForm::class,null,['method'=>'POST',
            'action'=> $this->generateUrl('create_city')
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $data        = $form->getData();
            $url         = 'http://192.168.56.51:8000/rest/city';

            $data_string = http_build_query([
                "name"        => $data['name'],
                "geoLocation" => $data['geoLocation'],
                "isoCode"     =>$data['isoCode']
            ]);
            $this->getCustomRequestUrl($url,"post",$data_string);
            return $this->redirectToRoute('create_city');
        }

        return $this->render('@App/xml/cities-create.html.twig',[
            'create_city_form' => $form->createView()
        ]);
    }
}