<?php

namespace Bundle\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('firstname', 'text');
        $builder->add('lastname', 'text');
        $builder->add('email', 'text');
        $builder->add('username', 'text');
        $builder->add('plainPassword', 'repeated', array('type' => 'password', 'required' => false));
    }

    public function getName()
    {
        return 'user';
    }
}
