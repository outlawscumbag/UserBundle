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

use FOS\UserBundle\Form\Type\RegistrationType as BaseType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\CallbackValidator;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('userRoles', 'entity', array(
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

    public function getName()
    {
        return 'fos_user_registration';
    }
}
