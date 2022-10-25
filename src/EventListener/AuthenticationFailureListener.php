<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthenticationFailureListener {

    /**
     * @param AuthenticationFailureEvent $event
     */
    public function onAuthenticationFailureResponse(AuthenticationFailureEvent $event): void
    {

        $response = new JWTAuthenticationFailureResponse('Identifiants invalides, veuillez vérifier les informations fournies', JsonResponse::HTTP_UNAUTHORIZED);
        $event->setResponse($response);
    }
}