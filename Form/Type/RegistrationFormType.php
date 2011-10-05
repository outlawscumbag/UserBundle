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
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\CallbackValidator;

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
            ->add('firstName')
            ->add('lastName')
            ->add('email', 'email')
            ->add('plainPassword', 'password', array( 
                'label' => 'Password', ))
            ->add('plainPasswordConfirm', 'password', array(
                'label' => 'Confirm',
                'property_path' => false, ))
            
            ->add('userRoles', 'entity', array( 
                'label' => 'Role', 
                'multiple' => true, 
                'expanded' => false,  
                'property' => 'altName', 
                'class' => 'Nooga\MainBundle\Entity\Role', )); 

        $builder->addValidator(new CallbackValidator(function($form)
        {
            if($form['plainPasswordConfirm']->getData() != $form['plainPassword']->getData()) {
                $form['plainPasswordConfirm']->addError(new FormError('Passwords must match.'));
            }
        }));
        
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
