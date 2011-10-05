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

class ResettingFormType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('new', 'password', array('label' => 'Password'))
                ->add('confirm', 'password', array('label' => 'Confirm', 'property_path' => false));

        $builder->addValidator(new CallbackValidator(function($form)
        {
            if($form['new']->getData() != $form['confirm']->getData()) {
                $form['confirm']->addError(new FormError('Passwords must match.'));
            }
        }));
    
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'FOS\UserBundle\Form\Model\ResetPassword');
    }

    public function getName()
    {
        return 'fos_user_resetting';
    }
}
