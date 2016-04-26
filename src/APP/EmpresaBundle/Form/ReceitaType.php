<?php

namespace APP\EmpresaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReceitaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $roles = ['Receita' => '0', 'Dispesar' => '1'];

        $builder
                ->add('titulo')
                ->add('tipo', ChoiceType::class, [ 'choices' => $roles])
                ->add('valorTotal')
                ->add('qtdParcela')
                //->add('status')
                //->add('empresa')
                ->add('parcelas', CollectionType::class, [
                    'mapped' => false,
                    'entry_type' => EmailType::class,
                    'entry_options' => [
                        'attr' => ['class' => 'email-box']
                    ]
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'APP\EmpresaBundle\Entity\Receita'
        ));
    }

}
