<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/22/2018
 * Time: 10:57 AM
 */

namespace AppBundle\Controller;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder->add('name',TextType::class)
               ->add('iSOCODE',TextType::class)
               ->add('geolocation',TextType::class,['required'   => false])
               ->add('submit',SubmitType::class);
    }
}