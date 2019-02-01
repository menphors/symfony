<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 1/24/2019
 * Time: 4:21 PM
 */
namespace AppBundle\Controller;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
Class UrlForm extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('url',TextType::class)
                ->add('Search',SubmitType::class);
    }
}