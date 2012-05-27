<?php

namespace Fran\PostBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Fran\PostBundle\Entity\Taxonomy;

class TaxonomyType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('type', 'choice', array(
                'choices' => Taxonomy::getTypes()
            ))
        ;
    }

    public function getName()
    {
        return 'fran_postbundle_taxonomytype';
    }
}
