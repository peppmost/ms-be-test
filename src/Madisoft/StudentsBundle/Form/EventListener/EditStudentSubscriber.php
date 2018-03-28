<?php

namespace Madisoft\StudentsBundle\Form\EventListener;

use Madisoft\StudentsBundle\Entity\Student;
use Madisoft\StudentsBundle\Form\SchoolGradeType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EditStudentSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        // Tells the dispatcher that you want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    /**
     * @param FormEvent $event
     */
    public function preSetData(FormEvent $event)
    {
        /** @var Student $student */
        $student = $event->getData();
        $form = $event->getForm();

        if ($student && null !== $student->getId()) {

            $form->add('schoolGrades', CollectionType::class, [
                'label' => false,
                'entry_type' => SchoolGradeType::class,
                'entry_options' => [
                    'label' => false,
                ],
                'allow_add' => true,
                'by_reference' => false,
                'prototype' => true,
                'prototype_data' => $student->getSchoolSubject()->getSchoolGradeConfiguration()
            ]);
        }
    }
}