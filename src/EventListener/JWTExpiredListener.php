<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;

class JWTExpiredListener {

    /**
     * @param JWTExpiredEvent $event
     */
    public function onJWTExpired(JWTExpiredEvent $event): void
    {
        /** @var JWTAuthenticationFailureResponse $response */
        $response = $event->getResponse();
        $event->getResponse()->getExpires();

        $response->setMessage('Votre token a expiré le ' . $response->getExpires()->format('d/m/Y à H:i:s') . '. Veuillez vous reconnecter pour obtenir un nouveau token');
    }
}