<?php

namespace AppBundle;


class Mailer 
{
   
	private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail($subject, $to, $body)
    {
        $msg = \Swift_Message::newInstance();

        $msg->setSubject($subject);
        $msg->setTo($to);
        $msg->setBody($body);
        $msg->setContentType('text/html');
        $msg->setCharset('utf-8');
        $msg->setFrom('nao-responda@producao.com');

        $this->mailer->send($msg);
    }
}
