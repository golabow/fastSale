<?php

namespace AppBundle\Services;

class MailerService {

  private $swiftMailer;

  public function __construct(\Swift_Mailer $swiftMailer) {
    $this->swiftMailer = $swiftMailer;
  }

  public function sendMail($title = 'test email', $from = 'fake@fastsale.com', $to = 'fake@example.com', string $message = 'test message', string $messageType = 'text/html'): void {
    $message = (new \Swift_Message($title))
            ->setFrom($from)
            ->setTo($to)
            ->setBody($message, $messageType);

    $this->swiftMailer->send($message);
  }

}
