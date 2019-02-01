<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/30/2018
 * Time: 9:56 AM
 */
namespace AppBundle\Controller;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CityForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id',HiddenType::class,['required'   => false])
            ->add('name',TextType::class)
            ->add('isoCode',TextType::class)
            ->add('geoLocation',TextType::class,['required'   => false])
            ->add('countryId',TextType::class,['required'   => false])
            ->add('submit',SubmitType::class);
    }
}