<?php

namespace Madisoft\StudentsBundle\Entity\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Madisoft\StudentsBundle\Entity\Student;
use Madisoft\StudentsBundle\Form\StudentType;

class StudentManager extends AbstractEntityManager
{
    public function getStudentsList(array $order = ['lastname' => 'ASC'])
    {
        return $this->getRepository()->findBy([], $order);
    }

    public function createStudent()
    {
        $class = $this->getClass();
        $student = new $class;
        return $student;
    }

    public function getStudentEditForm(Student $student, StudentType $studentForm)
    {
        $schoolGradeConfiguration = $student->getSchoolSubject()->getSchoolGradeConfiguration();

    }
}