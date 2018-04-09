<?php

namespace Madisoft\StudentsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     * @param $url
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        return array(
            array('/'),
            array('/student/new'),
            array('/student/edit/1'),
        );
    }

    public function testStudentNew()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/student/new');
        $client->getResponse()->getContent();

        $form = $crawler->selectButton('madisoft_studentsbundle_student_save')->form();
        $values = $form->getPhpValues();

        //add new student information with an already used email
        $values['madisoft_studentsbundle_student']['firstname'] = 'Roberto';
        $values['madisoft_studentsbundle_student']['lastname'] = 'Fico';
        $values['madisoft_studentsbundle_student']['email'] = 'dibba@5stelle.it';
        $values['madisoft_studentsbundle_student']['schoolSubject'] = 3;

        $form->setValues($values);
        $client->submit($form);

        $this->assertContains('Questo valore è già stato utilizzato.', $client->getResponse()->getContent());

        //set student email to a new valid email
        $values['madisoft_studentsbundle_student']['email'] = 'fico@5stelle.it';

        $form->setValues($values);
        $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertContains('Studente creato con successo', $client->getResponse()->getContent());
        $this->assertContains('fico@5stelle.it', $client->getResponse()->getContent());
    }

    public function testStudentEdit()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/student/edit/3');
        $this->assertContains('Taverna', $client->getResponse()->getContent());

        $client->getResponse()->getContent();

        $form = $crawler->selectButton('madisoft_studentsbundle_student_save')->form();
        $values = $form->getPhpValues();

        //edit student information
        $values['madisoft_studentsbundle_student']['firstname'] = 'Paoletta';

        //edit an existent school grade
        $values['madisoft_studentsbundle_student']['schoolGrades'][0]['description'] = 'Bravissimo';
        $values['madisoft_studentsbundle_student']['schoolGrades'][0]['grade'] = 7;

        //add a school grade
        $values['madisoft_studentsbundle_student']['schoolGrades'][2]['description'] = 'Appena Sufficiente';
        $values['madisoft_studentsbundle_student']['schoolGrades'][2]['grade'] = 6;
        $values['madisoft_studentsbundle_student']['schoolGrades'][2]['averageFlag'] = 1;

        $client->request($form->getMethod(), $form->getUri(), $values, $form->getPhpFiles());
        $crawler = $client->followRedirect();

        $this->assertContains('Studente modificato con successo', $client->getResponse()->getContent());
        $this->assertContains('Bravissimo', $client->getResponse()->getContent());
        $this->assertContains('Paoletta', $client->getResponse()->getContent());
        $this->assertContains('Appena Sufficiente', $client->getResponse()->getContent());
    }
}
