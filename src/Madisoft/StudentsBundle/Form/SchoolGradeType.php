<?php

namespace Madisoft\StudentsBundle\Form;

use Madisoft\StudentsBundle\Form\EventListener\SchoolGradeSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SchoolGradeType extends AbstractType
{
    private $schoolGradeSubscriber;
    public function __construct(SchoolGradeSubscriber $schoolGradeSubscriber)
    {
        $this->schoolGradeSubscriber = $schoolGradeSubscriber;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('grade',null, [
                'label' => 'Valutazione'
            ])
            ->add('description',null, [
                'label' => 'Descrizione'
            ])
            ->add('averageFlag',CheckboxType::class, [
                'label' => 'Media',
                'required' => false
            ])
            //->add('student', HiddenType::class)
            //->add('schoolSubject', HiddenType::class)
        ;
        $builder->addEventSubscriber($this->schoolGradeSubscriber);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Madisoft\StudentsBundle\Entity\SchoolGrade'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'madisoft_studentsbundle_schoolgrade';
    }


}
