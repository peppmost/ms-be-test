<?php

namespace Madisoft\StudentsBundle\Controller;

use Madisoft\StudentsBundle\Entity\Manager\StudentManager;
use Madisoft\StudentsBundle\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/", name="madisoft_students_index")
     * @param StudentManager $sm
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(StudentManager $sm)
    {
        return $this->render('@MadisoftStudents/index.html.twig',[
            'students' => $sm->getStudentsList()
        ]);
    }

    /**
     * @Route("/student/edit/{student}", name="madisoft_students_edit")
     * @param Request $request
     * @param Student $student
     * @param StudentManager $sm
     * @ParamConverter("student", class="MadisoftStudentsBundle:Student")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editStudentAction(Request $request, Student $student, StudentManager $sm)
    {
        $form = $this->createForm('Madisoft\StudentsBundle\Form\StudentType', $student);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $studentData = $form->getData();
            $student = $sm->save($studentData);
            $this->addFlash('success', 'Studente modificato con successo');
            return $this->redirectToRoute('madisoft_students_edit', ['student' => $student->getId()]);

        }

        return $this->render('@MadisoftStudents/studentEdit.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/student/new", name="madisoft_students_new")
     * @param Request $request
     * @param StudentManager $sm
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newStudentAction(Request $request, StudentManager $sm)
    {
        $student = $sm->createStudent();
        $form = $this->createForm('Madisoft\StudentsBundle\Form\StudentType', $student);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $studentData = $form->getData();
            $student = $sm->save($studentData);
            $this->addFlash('success', 'Nuovo studente creato con successo');
            return $this->redirectToRoute('madisoft_students_edit', ['student' => $student->getId()]);
        }

        return $this->render('@MadisoftStudents/studentNew.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
