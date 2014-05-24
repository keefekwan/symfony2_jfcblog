<?php

namespace JFC\ModelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class CommentType
 */
class CommentType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('authorName', null, array('label' => 'name'))
            ->add('body', null, array('label' => 'comment.singular'))
            ->add('post', 'submit', array('label' => 'send'));
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JFC\ModelBundle\Entity\Comment'
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'jfc_modelbundle_comment';
    }
}
