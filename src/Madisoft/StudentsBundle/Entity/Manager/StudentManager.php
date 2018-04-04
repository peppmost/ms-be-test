<?php

namespace Madisoft\StudentsBundle\Entity\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Madisoft\StudentsBundle\Entity\SchoolGrade;
use Madisoft\StudentsBundle\Entity\Student;
use Madisoft\StudentsBundle\Form\StudentType;

class StudentManager extends AbstractEntityManager
{
    /**
     * @param array $order
     * @return array
     */
    public function getStudentsList(array $order = ['lastname' => 'ASC'])
    {
        return $this->getRepository()->findBy([], $order);
    }

    /**
     * @return mixed
     */
    public function createStudent()
    {
        $class = $this->getClass();
        $student = new $class;
        return $student;
    }

    /**
     * @param Student $student
     * @return mixed
     */
    public function calculateGPA($student)
    {
        $schoolGradeConfiguration = $student->getSchoolSubject()->getSchoolGradeConfiguration();

        if($schoolGradeConfiguration->getGrade() === false){

            return false;
        }

        $schoolGrades = $student->getSchoolGrades();

        $gpa = false;
        $totalSchoolGrades = 0;
        $schoolGradesSum = 0;

        /** @var SchoolGrade $schoolGrade */
        foreach ($schoolGrades as $schoolGrade){

            $averageFlag = $schoolGrade->getAverageFlag();
            $totalSchoolGrades += $averageFlag === true ? 1 : 0;
            $schoolGradesSum += $averageFlag === true ? $schoolGrade->getGrade() : 0;
        }
        $gpa = round($schoolGradesSum / $totalSchoolGrades, 2);
        return $gpa;
    }
}