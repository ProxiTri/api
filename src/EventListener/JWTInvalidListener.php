<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTInvalidEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;

class JWTInvalidListener {

    /**
     * @param JWTInvalidEvent $event
     */
    public function onJWTInvalid(JWTInvalidEvent $event): void
    {
        $response = new JWTAuthenticationFailureResponse('Votre token n\'est pas valide. Veuillez vous identifier à nouveau', 403);

        $event->setResponse($response);
    }
}