<?php

namespace Madisoft\StudentsBundle\Doctrine;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Madisoft\StudentsBundle\Entity\Manager\StudentManager;
use Madisoft\StudentsBundle\Entity\SchoolGrade;
use Madisoft\StudentsBundle\Entity\Student;
use Madisoft\StudentsBundle\Form\SchoolGradeType;
use Madisoft\StudentsBundle\Utils\MailManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\Common\EventSubscriber;
use Symfony\Component\Translation\TranslatorInterface;

class SchoolGradeEventSubscriber implements EventSubscriber
{
    protected $container;

    protected $mailManager;

    protected $translator;

    public function __construct(Container $container,
                                MailManager $mailManager,
                                TranslatorInterface $translator
    )
    {
        $this->container = $container;
        $this->mailManager = $mailManager;
        $this->translator = $translator;
    }

    public function getSubscribedEvents()
    {
        return [
            'postUpdate'
        ];
    }

    /**
     * @param FormEvent $event
     */
    public function postUpdate(LifecycleEventArgs $eventArgs)
    {
        /** @var SchoolGrade $schoolGrade */
        $schoolGrade = $eventArgs->getObject();
        $student = $schoolGrade->getStudent();
        $this->sendEmail($student, $eventArgs);

    }

    private function sendEmail(Student $student, LifecycleEventArgs $eventArgs)
    {
        $sm = $this->container->get('Madisoft\StudentsBundle\Entity\Manager\StudentManager');
        $gpa = $sm->calculateGPA($student);
        $parameters = [
            'schoolGrade' => $eventArgs->getObject(),
            'gpa' => $gpa
        ];

        $this->mailManager->setEmailTo('peppmost@gmail.com');
        $this->mailManager->setEmailSubject($this->translator->trans('ms_students.emails.grade_variation_subject'));
        $this->mailManager->setEmailTemplateHtml('@MadisoftStudents/emails/schoolGradeModified.html.twig');
        $this->mailManager->setEmailTemplateText('@MadisoftStudents/emails/schoolGradeModified.html.twig');
        $this->mailManager->setParameters($parameters);
        $this->mailManager->sendEmail();
    }
}