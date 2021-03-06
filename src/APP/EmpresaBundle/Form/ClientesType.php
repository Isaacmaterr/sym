<?php

namespace APP\EmpresaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ClientesType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nome')
                ->add('email')
                ->add('endereco', TextType::class, [
                    'mapped' => false
                ])
                ->add('bairro', TextType::class, [
                    'mapped' => false
                ])
                ->add('uf', TextType::class, [
                    'mapped' => false
                ])
                ->add('cep', TextType::class, [
                    'mapped' => false
                ])
                ->add('telefones', CollectionType::class, [
                    'label' => FALSE,
                    'mapped' => false,
                    'entry_type' => TextType::class,
                    'entry_options' => [
                        
                    ]
                ])

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'APP\EmpresaBundle\Entity\Clientes'
        ));
    }

}
