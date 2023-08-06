<?php

namespace App\Form;

use App\Entity\Note;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('message', TextType:: class,[
                'label' => 'thông báo',
                'row_attr'=>[
                    'class' => 'text-primary',
                    'style' => 'font-size:100px',
                ],
                'attr' => [
                 //ghi chữ màu
                    'class' => 'text-primary',
                    // font chữ
                    'style' => 'font-size:15px',
                ], ])
            ->add('created', DateTimeType::class, ['widget'=>'single_text'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }
}
