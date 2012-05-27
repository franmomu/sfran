<?php

namespace Fran\PostBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TaxonomyType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('type')
            ->add('posts')
        ;
    }

    public function getName()
    {
        return 'fran_postbundle_taxonomytype';
    }
}
