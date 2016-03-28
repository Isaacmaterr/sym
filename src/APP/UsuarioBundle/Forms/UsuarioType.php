<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace APP\UsuarioBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

/**
 * Description of UsuarioType
 *
 * @author isaac
 */
class UsuarioType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $roles = ['Usuario Comun' => 'ROLE_USER', 'Usuario Adminiatrador' => 'ROLE_ADMIN'];
        $builder
                ->add("nome", TextType::class)
                ->add("email", EmailType::class)
                ->add("password", RepeatedType::class, ['type' => PasswordType::class])
                ->add("password", RepeatedType::class, ['type' => PasswordType::class])
                ->add("tipo", ChoiceType::class, [ 'choices' => $roles])
                ->add("telefones", TextType::class)
                ->add("endereco", TextType::class)
                ->add("bairro", TextType::class)
                ->add("uf", TextType::class)
                ->add("cep", TextType::class)
                ->add("salva", SubmitType::class, ['label' => "Salva"])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' =>null,
        ));
    }

}
