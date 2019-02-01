<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/18/2018
 * Time: 1:13 PM
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Country;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RestfullController extends Controller
{

    /**
     * @Route("/rest/countries/pagination/{page}" , name="app_country_pagination", methods={"GET"})
     * @param $page
     * @param $pagesize
     * @return JsonResponse
     */
    public function listCountryAction($page = 1, $pagesize = 10)
    {

        if ($page < 1) {
            return new JsonResponse(['error' => 'Cannot parse parameter lower than one']);
        }

        if (($pagesize < 10) || ($pagesize > 100)) {
            return new JsonResponse(['error' => 'Page size cannot be lower than 10 and between 10 and 100']);
        }
        $repository = $this->getDoctrine()->getRepository(Country::class);
        $countries = $repository->findBy([], ['name' => 'ASC'], $pagesize, ($page - 1) * $pagesize);

        return new JsonResponse(['country' => $countries], 200);
    }
}