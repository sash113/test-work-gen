<?php

namespace App\Form;

use App\Entity\Phone;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                    'constraints' => new NotBlank()
                ]
            )
            ->add('lastName', TextType::class, [
                'constraints' => new NotBlank()
            ])
//            ->add('phoneNumbers', CollectionType::class, [
//                'property_path' => 'phones',
//                'allow_add' => true,
//                'entry_type' => TelType::class,
//                'allow_extra_fields' => true
//            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'allow_extra_fields' => true,
            'validation_groups' => false,
            'data_class' => User::class,
        ]);
    }
}
