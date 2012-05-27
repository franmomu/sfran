<?php

namespace Fran\PostBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Fran\PostBundle\Entity\Taxonomy;
use Doctrine\ORM\EntityRepository;

class PostType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            //->add('taxonomies', null, array('expanded' => true))
            ->add('tags', 'entity', array(
                    'class' => 'FranPostBundle:Taxonomy',
                    'expanded' => true,
                    'multiple' => true,
                    'query_builder' => function(EntityRepository $repo){
                        $qb = $repo->createQueryBuilder('t');
                        $qb->where('t.type = :type');
                        $qb->setParameter('type', Taxonomy::TAG);
                    return $qb;
                }
            ))
            ->add('categories', 'entity', array(
                    'class' => 'FranPostBundle:Taxonomy',
                    'expanded' => true,
                    'multiple' => true,
                    'query_builder' => function(EntityRepository $repo){
                        $qb = $repo->createQueryBuilder('t');
                        $qb->where('t.type = :type');
                        $qb->setParameter('type', Taxonomy::CATEGORY);
                    return $qb;
                }
            ))
        ;
    }

    public function getName()
    {
        return 'fran_postbundle_posttype';
    }
}
