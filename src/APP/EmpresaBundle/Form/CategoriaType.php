<?php

namespace APP\EmpresaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class CategoriaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $empresar = $options['data']['empresar'];
        $builder
                ->add('nome')
                ->add('pai', EntityType::class, [
                      'placeholder' => 'Choose your gender',
                    'empty_data'=>null,
                    'class' => 'EmpresaBundle:Categoria',
                    'query_builder' => function (EntityRepository $er) use ($empresar) {
                        return $er->createQueryBuilder('u')
                                ->where('u.status=1')
                                 ->andWhere(' u.empresar=:empresar')
                                ->setParameter('empresar', $empresar)
                                ->orderBy('u.nome', 'ASC');
                    }]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }

}