<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/24/2018
 * Time: 9:13 AM
 */
namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class,['required' =>false,'attr' =>
            ['placeholder' => 'Search Name...']
        ])->add('countryId', HiddenType::class);
        $builder->add('submit', SubmitType::class);
    }
}