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
                'label' => 'Nome'
            ])
            ->add('lastname', null, [
                'label' => 'Cognome'
            ])
            ->add('email', null, [
                'label' => 'Email'
            ])
            ->add('schoolSubject', EntityType::class, [
                'class' => 'Madisoft\StudentsBundle\Entity\SchoolSubject',
                'choice_label' => 'title',
                'label' => 'Materia',
                'placeholder' => 'Seleziona una materia'
            ])
        ;

        $builder->addEventSubscriber(new EditStudentSubscriber());

        $builder->add('save', SubmitType::class, array(
            'attr' => array('class' => 'save')));
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
