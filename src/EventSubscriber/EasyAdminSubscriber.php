<?php

namespace App\EventSubscriber;

use App\Entity\App;
use App\Entity\Job;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Uid\Uuid;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['setUuid'],
        ];
    }

    public function setUuid(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Job || $entity instanceof App)) {
            return;
        }

        $uuid = Uuid::v4();
        $entity->setUuid($uuid);

        return;
    }
}
