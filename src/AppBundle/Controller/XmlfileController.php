<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;

class XmlfileController extends Controller
{
    /**
     * @Route("/xmlfile", name="xml")
     * @return Response The response to render
     */
    public function xmlfileAction (){
        $html = '<?xml version="1.0"?>
                <note>
                    <to>Tove</to>
                    <from>Jani</from>
                    <heading>Reminder</heading>
                    <body>Don\'t forget me this weekend!</body>
                </note>';
        $crawler = new Crawler($html);
        $arr = [];
        foreach ($crawler as $domElement) {
            $arr[] =  $domElement->nodeName;
        }
        //echo $arr;
        return $this->render('@App/xml/read_xml_file.html.twig',compact('arr'));
    }
    /**
     *
     * @Route("/index", name="")
     * @return Response The response to render
     */
    public function indexAction()
    {
        $crawler = new Crawler('<?xml version="1.0"?><BookHotelResponse>
                                  <success>true</success>
                                  <bookingReference>TO0000000</bookingReference>
                                  <room seqNo="0">
                                    <providerDetails name="Booking Office" bookingReference="DZ35S4" />
                                  </room>
                                </BookHotelResponse>');
        return $this->render('@App/TestController/index.html.twig', array(
            'xml_reader'  => $crawler->html()
        ));
    }
    /**
     *
     * @Route("/test")
     * @return Response The response to render
     */
    public function testAction()
    {
        $form = $this->createFormBuilder()
            ->add('Firstname', TextType::class)
            ->add('Lastname', TextType::class)
            ->add('Email', EmailType::class)
            ->add('Submit', SubmitType::class)
            ->getForm();
        return $this->render('@App/TestController/test.html.twig', [
            'output_form' => $form->createView(),
        ]);
    }
}