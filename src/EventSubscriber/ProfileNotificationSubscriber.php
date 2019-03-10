<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\EventSubscriber;

use App\Entity\Employee;
use App\Events;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Notifies post's author about new comments.
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class ProfileNotificationSubscriber implements EventSubscriberInterface
{
    private $mailer;
    private $translator;
    private $urlGenerator;
    private $logger;
    private $sender;

    public function __construct(\Swift_Mailer $mailer, UrlGeneratorInterface $urlGenerator, TranslatorInterface $translator,LoggerInterface $logger, $sender)
    {
        $this->mailer = $mailer;
        $this->urlGenerator = $urlGenerator;
        $this->translator = $translator;
        $this->logger = $logger;
        $this->sender = $sender;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            Events::PROFILE_SEEN => 'onProfileSeen',
        ];
    }

    public function onProfileSeen(GenericEvent $event): void
    {
        /** @var Employee $employee */
        $employee = $event->getSubject();

        $subject = $this->translator->trans('notification.profile_seen');
        $body = $this->translator->trans('notification.profile_seen.description', [
            '%name%' => $employee->getName(),
        ]);

        $this->logger->alert($body);

        $message = (new \Swift_Message())
            ->setSubject($subject)
            ->setTo($employee->getEmail())
            ->setFrom($this->sender)
            ->setBody($body, 'text/html')
        ;

        $this->mailer->send($message);
    }
}
