<?php

namespace APP\EmpresaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class CategoriaType extends AbstractType {

    private $empresar;

    function getEmpresar() {
        return $this->empresar;
    }

    function setEmpresar($empresar) {
        $this->empresar = $empresar;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $empresar = $options['data']->getEmpresar();
    
        $builder
                ->add('nome')
                ->add('pai', EntityType::class, [
                    'required'=> false,
                    'placeholder' => 'Choose your gender',
                    'empty_data' => null,
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
            'data_class' =>'APP\EmpresaBundle\Entity\Categoria'
        ));
    }

}
