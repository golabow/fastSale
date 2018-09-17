<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Currency;

class ProductForm extends AbstractType {

  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults(array(
        'csrf_protection' => true,
        'csrf_field_name' => '_csrf_token',
        // a unique key to help generate the secret token
        'csrf_token_id' => 'fast_sale_token',
            //'allow_extra_fields' => true
    ));
  }

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
            ->add('name', Type\TextType::class, array(
                'label' => 'Product name'
            ))
            ->add('type', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                'label' => 'Product type',
                'class' => 'AppBundle:ProductType',
                'choice_label' => 'name'
            ))
            ->add('description', Type\TextareaType::class, array(
                'label' => 'Product description'
            ))
            ->add('price', Type\MoneyType::class, array(
                'label' => 'Product price',
            ))
            ->add('currency', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array(
                'label' => 'Price currency',
                'class' => 'AppBundle:Currency',
                'choice_label' => 'name'
    ));
    /* ->add('name', array(
      ))
      ->add('description', null, array(
      'widget' => 'single_text'
      ))
      ->add('price', array(

      ))
      ->add('currency', array(

      )); */
  }

  public function getBlockPrefix() {
    return '';
  }

  public function getErrorsss() {
    return $this->getError();
  }

}
