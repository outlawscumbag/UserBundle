<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class RegistrationFormType extends AbstractType
{
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('first_name')
            ->add('last_name')
            ->add('email', 'email')
            ->add('plainPassword', 'repeated', array('type' => 'password'))
            ->add('userRoles', 'entity', array( 'label' => 'Role', 'multiple' => true, 'expanded' => true,  'property' => 'Name', 'class' => 'Nooga\MainBundle\Entity\Role'));
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => $this->class);
    }

    public function getName()
    {
        return 'fos_user_registration';
    }
}
