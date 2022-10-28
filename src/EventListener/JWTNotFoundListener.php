<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class JWTNotFoundListener {

    /**
     * @param JWTNotFoundEvent $event
     */
    public function onJWTNotFound(JWTNotFoundEvent $event): void
    {
        $data = [
            'status'  => '403 Forbidden',
            'message' => 'Le token n\'a pas été trouvé dans la requête. Veuillez vous connecter et insérer votre token dans la requête',
        ];

        $response = new JsonResponse($data, 403);

        $event->setResponse($response);
    }
}