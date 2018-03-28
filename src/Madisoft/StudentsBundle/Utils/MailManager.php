<?php

namespace Madisoft\StudentsBundle\Utils;

class MailManager
{
    protected $mailer;

    protected $templateManager;

    protected $emailSubject;

    protected $emailFrom;

    protected $emailTo;

    protected $emailTemplateText;

    protected $emailTemplateHtml;

    protected $parameters;


    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templateManager)
    {
        $this->mailer = $mailer;
        $this->templateManager = $templateManager;
    }

    public function sendEmail()
    {
        $message = new \Swift_Message();
        $message->setFrom($this->getEmailFrom())
            ->setSubject($this->getEmailSubject())
            ->setTo($this->getEmailTo())
            ->setBody($this->templateManager->render(
                    $this->emailTemplateHtml, $this->parameters
                ), 'text/html'
            )->addPart($this->templateManager->render(
                $this->emailTemplateText, $this->parameters
                ), 'text/plain'
            )
        ;
        $this->mailer->send($message);
    }

    /**
     * @return mixed
     */
    public function getEmailSubject()
    {
        return $this->emailSubject;
    }

    /**
     * @param mixed $emailSubject
     */
    public function setEmailSubject($emailSubject)
    {
        $this->emailSubject = $emailSubject;
    }

    /**
     * @return mixed
     */
    public function getEmailFrom()
    {
        return $this->emailFrom;
    }

    /**
     * @param mixed $emailFrom
     */
    public function setEmailFrom($emailFrom)
    {
        $this->emailFrom = $emailFrom;
    }

    /**
     * @return mixed
     */
    public function getEmailTo()
    {
        return $this->emailTo;
    }

    /**
     * @param mixed $emailTo
     */
    public function setEmailTo($emailTo)
    {
        $this->emailTo = $emailTo;
    }

    /**
     * @return mixed
     */
    public function getEmailTemplateText()
    {
        return $this->emailTemplateText;
    }

    /**
     * @param mixed $emailTemplateText
     */
    public function setEmailTemplateText($emailTemplateText)
    {
        $this->emailTemplateText = $emailTemplateText;
    }

    /**
     * @return mixed
     */
    public function getEmailTemplateHtml()
    {
        return $this->emailTemplateHtml;
    }

    /**
     * @param mixed $emailTemplateHtml
     */
    public function setEmailTemplateHtml($emailTemplateHtml)
    {
        $this->emailTemplateHtml = $emailTemplateHtml;
    }



    /**
     * @return mixed
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param mixed $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }


}