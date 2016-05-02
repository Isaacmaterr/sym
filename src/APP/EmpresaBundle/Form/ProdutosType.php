<?php

namespace APP\EmpresaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


use Doctrine\ORM\EntityRepository;




class ProdutosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $empresar=$options['data']->getEmpresar();
       
        $builder
            ->add('nome')
            ->add('valor')
            ->add('descricao',TextareaType::class)
            ->add('quantidade',NumberType::class)
            ->add('filePrincipal',FileType::class,['mapped'=>false])
            ->add('fileMult',FileType::class,['mapped'=>false,'multiple'=>true])
            ->add('salvar',SubmitType::class)
            ->add('categoria',EntityType::class, [
                    'placeholder' => 'Escolha uma categoria',
                    'empty_data'=>null,
                    'class' => 'EmpresaBundle:Categoria',
                    'query_builder' => function (EntityRepository $er) use ($empresar) {
                        return $er->createQueryBuilder('u')
                                ->where('u.status=1')
                                 ->andWhere(' u.empresar=:empresar')
                                ->setParameter('empresar', $empresar)
                                ->orderBy('u.nome', 'ASC');
                    }])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'APP\EmpresaBundle\Entity\Produtos'
        ));
    }
}
