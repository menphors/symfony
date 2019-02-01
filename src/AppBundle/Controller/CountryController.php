<?php

namespace AppBundle\Controller;
use Doctrine\DBAL\Driver\Connection;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
class CountryController extends Controller
{
    /**
     *
     * @Route("/xmlresponse")
     * @return Response $response
     */
    public function xmlresponseAction(){

        $xml_data = '<?xml version="1.0" encoding="UTF-8" ?>
        <soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:xsd="http://request.ws.hotelston.com/xsd" xmlns:xsd1="http://types.ws.hotelston.com/xsd">
           <soap:Header/>
           <soap:Body>
              <xsd:HotelListRequest>
                 <xsd:locale>en</xsd:locale>
                 <xsd:loginDetails xsd1:email="dgalleri@adalte.com" xsd1:password="adalte2018" />
              </xsd:HotelListRequest>
           </soap:Body>
        </soap:Envelope>';

        $URL = "http://dev.hotelston.com/ws/HotelService.HotelServiceHttpSoap12Endpoint/";
        $ch = curl_init($URL);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/soap+xml','UTF-8'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $response = new Response($output);
        $response->headers->set('Content-Type', 'application/soap+xml');
        return $response;

    }
    /**
     * @Route("/add-countries")
     */
    public function getCountryAction() {
        //get directory xml file location
        $path = realpath($this->get('kernel')->getRootDir() . '/Resources/Public/xmlresponse.xml');
        $feed = file_get_contents($path);
        $xml  = simplexml_load_string($feed,'SimpleXMLElement', LIBXML_COMPACT | LIBXML_PARSEHUGE);
        $xml->registerXPathNamespace("xsd","http://response.ws.hotelston.com/xsd");
        $xml->registerXPathNamespace("xsd1","http://types.ws.hotelston.com/xsd");
        $xml->registerXPathNamespace("soapenv","http://www.w3.org/2003/05/soap-envelope");
        //$string = html_entity_decode($feed, ENT_QUOTES, "utf-8");
        /** @var Connection $connection */
        $connection     = $this->getDoctrine()->getConnection();
        $countriesSql   = [];
        $citiesSql      = [];
        $hotelSql       = [];
        //$hotelSql       = [];
        //xpath query to get xml value
        foreach($xml->xpath('soapenv:Body/xsd:HotelListResponse/xsd:country') as $countryNode) {
            //quote escape sql injection string
            $countryId      = $connection->quote((string) $countryNode->attributes('xsd1', true)['id']);
            $countryName    = $connection->quote((string) $countryNode->attributes('xsd1', true)['nameEn']);
            $countryCode    = $connection->quote((string) $countryNode->attributes('xsd', true)['isoCode']);
            $countriesSql[] = "({$countryId}, {$countryName}, {$countryCode})";

            foreach ($countryNode->children('xsd',true) as $child){
                if($child->getName() == 'state'){
                    foreach ($child->children('xsd',true)->city as $cityNode){
                            $cityId = $connection->quote((string)$cityNode->attributes('xsd1', true)['id']);
                            $cityName = $connection->quote((string)$cityNode->attributes('xsd1', true)['nameEn']);
                            $cityCode = $connection->quote((string)$cityNode->attributes('xsd', true)['isoCode']);
                            $citiesSql[] = "({$cityId},{$cityName},{$cityCode},{$countryId})";
                        foreach ($cityNode->children('xsd',true)->hotel as $hotelNode) {
                            $hotelId = $connection->quote((string)$hotelNode->attributes('xsd1', true)['id']);
                            $hotelName = $connection->quote((string)$hotelNode->attributes('xsd1', true)['name']);
                            $hotelSql[]   = "({$hotelId},{$hotelName})";
                        }
                    }
                }else{
                        $cityId     = $connection->quote((string)$child->attributes('xsd1', true)['id']);
                        $cityName   = $connection->quote((string)$child->attributes('xsd1', true)['nameEn']);
                        $cityCode   = $connection->quote((string)$child->attributes('xsd', true)['isoCode']);
                        $citiesSql[] = "({$cityId},{$cityName},{$cityCode},{$countryId})";

                        foreach ($child->children('xsd',true)->hotel as $hotelNode) {
                            $hotelId = $connection->quote((string)$hotelNode->attributes('xsd1', true)['id']);
                            $hotelName = $connection->quote((string)$hotelNode->attributes('xsd1', true)['name']);
                            $hotelSql[]   = "({$hotelId},{$hotelName})";
                        }
                    }
                }
            }

        $connection->beginTransaction();
        try {
            if (count($countriesSql) > 0) {

                $sql_countries = 'INSERT INTO country (id, name,ISO_code)
                                  VALUES ' . implode(', ', $countriesSql);
                $sql_countries .= " ON DUPLICATE KEY UPDATE name=name, ISO_code=ISO_code ";
                $connection->exec($sql_countries);
                //$countriesSql   = [];
                // save countries on db
            }

            if (count($citiesSql)) {

                $sql_cities_in_state = "INSERT INTO city (id, name,ISO_code,CountryID) ";
                $sql_cities_in_state .= " VALUES " . implode(', ', $citiesSql);
                $sql_cities_in_state .= " ON DUPLICATE KEY UPDATE name=name,ISO_code=ISO_code,CountryID=CountryID";
                $connection->exec($sql_cities_in_state);
            }
            //it will exhaust memory it has much data you have to avoid that
            if(count($hotelSql)) {
                $hotel_insert_sql = 'INSERT INTO hotel (id,name) VALUES' .implode(', ', $hotelSql);
                $hotel_insert_sql .= " ON DUPLICATE KEY UPDATE name=name";
                $connection->exec($hotel_insert_sql);
            }

            $connection->commit();
        }catch (Exception $exception){
            $connection->rollBack();
            return $exception;
        }
        return new Response('success',200);
    }
    /**
     * @Route("hotel-listing")
     */
    public function listHotelAction () {
        echo "Hi";
        exit;
    }
}
