<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'user.username',
                'attr' => ['placeholder' => 'user.username'],
            ])
            ->add('email', TextType::class, [
                'label' => 'user.email',
                'attr' => ['placeholder' => 'user.email'],
            ])
            ->add('role', ChoiceType::class, [
                'choices' => [
                    'user' => 'ROLE_USER',
                    'manager' => 'ROLE_MANAGER',
                    'admin' => 'ROLE_ADMIN',
                ],
                'label' => 'user.role',
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Different passwords!',
                'first_options' => [
                    'label' => 'user.password',
                    'attr' => ['placeholder' => 'user.password'],
                ],
                'second_options' => [
                    'label' => 'user.repeat_password',
                    'attr' => ['placeholder' => 'user.repeat_password'],
                ],
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'app_bundle_user_type';
    }
}
