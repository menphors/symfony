<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CountryApiController extends Controller
{
    use PutRequestTrait;
    /**
     * @Route("/rest/countries/list", name="countries")
     * @param Request $request
     * @return String $obj
     */
    public function requestCountryAction(Request $request){

        $page       = $request->get('page', 1);
        $pagesize   = $request->get('pagesize',100);
        if (!$page) {
            throw new \InvalidArgumentException('Page: ' . $page . ' does not exist');
        }
        if($page < 1){
            $page = 1;
            // TODO error message on page, not JSON
            $this->addFlash('error', 'Page parameter cannot type lower or equal to zero!');
        }
        if($pagesize > 100){
            $this->addFlash('error', 'Page size parameter cannot greater than 100!');
        }
        $form = $this->createForm(SearchForm::class, null, ['method'=> 'GET']);

        $form->handleRequest($request);

        if(($form->isSubmitted() && $form->isValid()) && (!empty($name = $form->getData()['name']))){
            $url = "http://192.168.56.51:8000/rest/countries?name=".$name;
            $countries  = $this->getRequestUrl($url);
        } else {
            $url = 'http://192.168.56.51:8000/rest/countries?page='.$page.'&&pagesize='.$pagesize;
            $countries  = $this->getRequestUrl($url);
        }

        return $this->render('@App/xml/countries-list.html.twig',[
            'countries'=>$countries,
            'page'=>$page,
            'search_form' =>$form->createView()
        ]);
    }
    /**
     * @Route("rest/countries/create", name="add_countries")
     * @param Request $request
     * @return Response
     */
    public function createCountryAction(Request $request){

        $form   = $this->createForm(Form::class,['method'=>'POST',
        'action'=>$this->generateUrl('add_countries')]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $data        = $form->getData();
            $url         = 'http://192.168.56.51:8000/rest/country';
            $data_string = http_build_query([
                "name"        => $data['name'],
                "geolocation" => $data['geolocation'],
                "isoCode"     =>$data['iSOCODE']
            ]);

            $this->getCustomRequestUrl($url,"post",$data_string);
            return $this->redirectToRoute('countries');
        }

        return $this->render('@App/xml/countries-create.html.twig',[
            'create_form' => $form->createView()
        ]);
    }
    /**
     * @Route("/rest/countries/{id}/edit", name="countries_edit")
     * @param int $id
     * @return JsonResponse
     */
    public function editCountryAction($id){

        $data = http_build_query(array('isoCode'=>'dog','name'=>'asd2'));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://192.168.56.51:8000/rest/country/'.$id);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response  = curl_exec($ch);
        curl_close($ch);

        return new JsonResponse($response);
    }
    /**
     * @Route("/rest/countries/update/{id}",name="country_update_form")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function updateCountryAction($id, Request $request){

        $url        = 'http://192.168.56.51:8000/rest/country/'.$id;
        $response   = $this->getRequestUrl($url);
        $country['id']          = $response->id;
        $country['name']        = $response->name;
        $country['geolocation'] = $response->geolocation;
        $country['iSOCODE']     = $response->iSOCODE;
        $form                   = $this->createForm(Form::class,$country,[
                        'method'=>'POST',
                        'action'=>$this->generateUrl('country_update_form',
                        ['id'=>$id])
        ]);

        $form->handleRequest($request);
        if (!$id) {
            throw new \InvalidArgumentException('The ID: ' . $id . ' does not exist');
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $data        = $form->getData();
            $data_string = http_build_query([
                "name"   => $data['name'],
                "geolocation" => $data['geolocation'],
                "isoCode"=>$data['iSOCODE']
            ]);
            $this->getCustomRequestUrl($url,"put",$data_string);

            return $this->redirectToRoute('countries');
        }
        return $this->render('@App/xml/countries-edit.html.twig', [
            'update_form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/rest/countries/{id}/delete",name="country_delete")
     * @param int $id
     * @return  Response
     */
    public function deleteCountryAction($id){

        if ($id) {

            $url    = "http://192.168.56.51:8000/rest/country/".$id;
            $delete_country = $this->getCustomRequestUrl($url,'delete');

            if($delete_country){

                $this->addFlash('error', 'Deleted Country Successfully!');

            }

        }else{
            $this->addFlash('error', 'ID of Country wasn\'t correct !');
        }
        return $this->redirectToRoute('countries');
    }
    /**
     * @Route("/rest/countries/{name}/search",name="country_search")
     * @param String $name
     * @param Request $request
     * @return Response
     */
    public function searchCountryByNameAction(Request $request, $name){
        $url    = "http://192.168.56.51:8000/rest/countries?name=".$name;
        $search_countries  = $this->getRequestUrl($url);
        $form = $this->createForm(SearchForm::class,['method'=>'POST',
            'action'=>$this->generateUrl('countries')]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->getCustomRequestUrl($url,'post',$data);
        }

        return $this->render('@App/xml/countries-list.html.twig',[
            'countries'=>$search_countries,
            'search_form' =>$form->createView()
        ]);
    }
}
