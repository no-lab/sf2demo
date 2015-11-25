<?php
namespace FrontEndBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dueDate', null, array('widget' => 'single_text'))
            ->add('amount')
            ->add('reference')
            ->add('sellerEmail')
            ->add('save', 'submit')
        ;
    }

    public function getName()
    {
        return 'invoice';
    }
}
