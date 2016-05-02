<?php

namespace APP\EmpresaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class ReceitaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $roles = ['Receita' => '0', 'Dispesar' => '1'];

        $empresar = $options['data']->getEmpresa();

        $builder
                ->add('titulo')
                ->add('tipo', ChoiceType::class, [ 'choices' => $roles])
                ->add('valorTotal')
                ->add('qtdParcela', TextType::class)
                //->add('status')
                //->add('empresa')
                ->add('parcelas', CollectionType::class, [
                    'label' => FALSE,
                    'mapped' => false,
                    'entry_type' => TextType::class,
                    'entry_options' => [
                        'attr' => ['class' => 'email-box']
                    ]
                ])
                ->add('servico', EntityType::class, [
                    'required'=>false,
                    'placeholder' => 'Escolha um serviço',
                    'empty_data' => null,
                    'class' => 'EmpresaBundle:Servicos',
                    'query_builder' => function (EntityRepository $er) use ($empresar) {
                        return $er->createQueryBuilder('u')
                                ->Where(' u.empresar=:empresar')
                                ->setParameter('empresar', $empresar)
                                ->orderBy('u.nome', 'ASC');
                    }])
                ->add('cliente', EntityType::class, [
                    'required'=>false,
                    'placeholder' => 'Escolha um cliente',
                    'empty_data' => null,
                    'class' => 'EmpresaBundle:Clientes',
                    'query_builder' => function (EntityRepository $er) use ($empresar) {
                        return $er->createQueryBuilder('u')
                                ->Where(' u.empresar=:empresar')
                                ->setParameter('empresar', $empresar)
                                ->orderBy('u.nome', 'ASC');
                    }])
        ;
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
