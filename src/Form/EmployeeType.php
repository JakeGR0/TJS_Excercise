<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('first_name',TextType::class,[
                'label' => 'First name:',
                'required' => true

            ])
            ->add('last_name',TextType::class,[
                'label' => 'Last name:',
                'required' => true
            ])
            ->add('d_o_b',DateType::class,[
                
                'widget' => 'single_text',
                'label' => 'Date of birth:',
                'required' => true
            ])
            ->add('email',EmailType::class,[
                'label' => 'Email address:',
                'required' => true
            ])
            ->add('submit',SubmitType::class,[
                'label' => 'SUBMIT'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
