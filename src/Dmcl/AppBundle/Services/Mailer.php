<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dmcl\AppBundle\Services;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Mailer\MailerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 */
class Mailer implements MailerInterface
{
    protected $mailer;
    protected $router;
    protected $templating;
    protected $parameters;
    protected $container;
    public function __construct(ContainerInterface $container,$mailer, UrlGeneratorInterface  $router, EngineInterface $templating, array $parameters)
    {
        $this->mailer = $mailer;
        $this->router = $router;
        $this->templating = $templating;
        $this->parameters = $parameters;
        $this->container =$container;
    }

    /**
     * {@inheritdoc}
     */
    public function sendConfirmationEmailMessage(UserInterface $user)
    {
        $template = $this->parameters['confirmation.template'];
        $url = $this->router->generate('fos_user_registration_confirm', array('token' => $user->getConfirmationToken()), true);
        $rendered = $this->templating->render($template, array(
            'user' => $user,
            'confirmationUrl' =>  $url
        ));
        $this->sendEmailMessage($rendered, $this->parameters['from_email']['confirmation'], $user->getEmail());
    }

    /**
     * {@inheritdoc}
     */
    public function sendResettingEmailMessage(UserInterface $user)
    {
        $template = $this->parameters['resetting.template'];
        $url = $this->router->generate('fos_user_resetting_reset', array('token' => $user->getConfirmationToken()), true);
        $rendered = $this->templating->render($template, array(
            'user' => $user,
            'confirmationUrl' => $url
        ));
        $this->sendEmailMessage($rendered, $this->parameters['from_email']['resetting'], $user->getEmail());
    }

    /**
     * @param string $renderedTemplate
     * @param string $fromEmail
     * @param string $toEmail
     * @return int|null
     */
    protected function sendEmailMessage($renderedTemplate, $fromEmail, $toEmail)
    {
        // Render the email, use the first line as the subject, and the rest as the body
        $renderedLines = explode("\n", trim($renderedTemplate));
        $subject = $renderedLines[0];
        $body = implode("\n", array_slice($renderedLines, 1));
        return $this->sendMail($subject,$toEmail,$body);
    }

    public function sendMail($subject, $toEmail, $body)
    {
        $config = $this->container->get("app.config.services")->getGeneralConfig();
        if($config){
            $message = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($config->getCompanyEmailSupport())
                ->setTo($toEmail)
                ->setSender($config->getEmailSender())
                ->setBody($body,'text/html');

            if($config->getEmailServiceType()!="local"){
                $transport = \Swift_SmtpTransport::newInstance($config->getEmailHost(), $config->getEmailPort(), $config->getEmailEncryptionMode())
                    ->setUsername($config->getEmailUsername())
                    ->setPassword($config->getEmailPassword());
                $transport->setAuthMode($config->getEmailAuthenticationMode());
                $this->mailer = \Swift_Mailer::newInstance($transport);
            }
            try {
                return $this->mailer->send($message);
            } catch (\Exception $e) {
                @file_put_contents($this->container->getParameter("kernel.logs_dir")."/mail.log",$e);
                return null;
            }
        }
    }
}
