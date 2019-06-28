<?php
/**
 * Change password type.
 */

namespace App\Form;

use App\Entity\ChangePassword;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ChangePasswordType.
 */
class ChangePasswordType extends AbstractType
{
    /**
     * Build Form function.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('oldPassword', PasswordType::class, [
            'label' => 'Stare haslo',
            'required' => true,
        ]);
        $builder->add('newPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'required' => true,
            'first_options' => ['label' => 'Hasło'],
            'second_options' => ['label' => 'Powtórz hasło'],
        ]);
    }

    /**
     * Configure Options function.
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => ChangePassword::class]);
    }

    /**
     * Get Block Prefix function.
     *
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'changePassword';
    }
}
