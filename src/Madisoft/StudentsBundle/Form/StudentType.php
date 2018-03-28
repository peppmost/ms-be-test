<?php

namespace Madisoft\StudentsBundle\Form;

use Madisoft\StudentsBundle\Form\EventListener\EditStudentSubscriber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class StudentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', null, [
                'label' => 'ms_students.firstname'
            ])
            ->add('lastname', null, [
                'label' => 'ms_students.lastname'
            ])
            ->add('email', null, [
                'label' => 'ms_students.email'
            ])
            ->add('schoolSubject', EntityType::class, [
                'class' => 'Madisoft\StudentsBundle\Entity\SchoolSubject',
                'choice_label' => 'title',
                'label' => 'ms_students.subject',
                'placeholder' => 'ms_students.subject_placeholder'
            ])
        ;

        $builder->addEventSubscriber(new EditStudentSubscriber());

        $builder->add('save', SubmitType::class, [
            'label' => 'ms_students.button.save',
            'attr' => ['class' => 'save']
        ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Madisoft\StudentsBundle\Entity\Student'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'madisoft_studentsbundle_student';
    }


}
