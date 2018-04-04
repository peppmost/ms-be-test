<?php

namespace Madisoft\StudentsBundle\Form\EventListener;

use Doctrine\ORM\Mapping\ClassMetadata;
use Madisoft\StudentsBundle\Entity\Manager\SchoolGradeConfigurationManager;
use Madisoft\StudentsBundle\Entity\SchoolGrade;
use Madisoft\StudentsBundle\Entity\SchoolGradeConfiguration;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;

class SchoolGradeSubscriber implements EventSubscriberInterface
{
    protected $sgcm;

    /**
     * SchoolGradeSubscriber constructor.
     * @param SchoolGradeConfigurationManager $sgcm
     */
    public function __construct(SchoolGradeConfigurationManager $sgcm) {
        $this->sgcm = $sgcm;
    }

    /**
     * @return array
     */
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

        /** @var SchoolGrade $schoolGrade */
        $data = $event->getData();
        $form = $event->getForm();

        if ($data instanceof SchoolGrade){

            $schoolGrade = $data;
            $student = $schoolGrade->getStudent();

            if ($student && null !== $student->getId()) {

                $schoolGradeConfiguration = $student->getSchoolSubject()->getSchoolGradeConfiguration();
                $this->removeUnconfiguredFields($form, $schoolGradeConfiguration);
            }
        }elseif ($data instanceof SchoolGradeConfiguration){

            $schoolGradeConfiguration = $data;
            $this->removeUnconfiguredFields($form, $schoolGradeConfiguration);
            $event->setData(new SchoolGrade());
        }
    }

    /**
     * @param FormInterface $form
     * @param SchoolGradeConfiguration $schoolGradeConfiguration
     */
    protected function removeUnconfiguredFields(FormInterface $form, SchoolGradeConfiguration $schoolGradeConfiguration)
    {
        /** @var ClassMetadata $fieldNames */
        $fieldNames = $this->sgcm->getEntityFields();
        foreach ($fieldNames->getFieldNames() as $fieldName ){

            $getter = 'get'.ucwords($fieldName);
            if(!$schoolGradeConfiguration->$getter()){
                $form->remove($fieldName);
            }
        }
    }
}