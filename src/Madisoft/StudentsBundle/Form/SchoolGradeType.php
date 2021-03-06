<?php

namespace Madisoft\StudentsBundle\Form;

use Madisoft\StudentsBundle\Form\EventListener\SchoolGradeSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SchoolGradeType extends AbstractType
{
    private $schoolGradeSubscriber;

    /**
     * SchoolGradeType constructor.
     * @param SchoolGradeSubscriber $schoolGradeSubscriber
     */
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
                'label' => 'ms_students.grade',
                'required' => true,
                'attr' => [
                    'class' => 'sg-grade'
                ]
            ])
            ->add('description',TextareaType::class, [
                'label' => 'ms_students.description',
                'required' => true,
                'attr' => [
                    'class' => 'sg-description'
                ]
            ])
            ->add('averageFlag',CheckboxType::class, [
                'label' => 'ms_students.averageFlag',
                'required' => false,
                'attr' => [
                    'class' => 'sg-averageCheckbox'
                ]
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
