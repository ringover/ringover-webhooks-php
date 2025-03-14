<?php

//php -S localhost:8887 webhook.php

use Psr\Http\Server\RequestHandlerInterface;
use RingoverSDK\Model\ContactEventResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RingoverSDK\Model\ContactSearchEventResponse;
use RingoverSDK\Model\ContactSearchNumberEventResponse;
use RingoverSDK\Service\ValidationWebhookEvent;
use Slim\Factory\AppFactory;
use RingoverSDK\Transformer\EventRequestTransformer;
use Slim\Middleware\BodyParsingMiddleware;

require_once __DIR__ . '/vendor/autoload.php';

const JWT_SECRET = 'MY_SECRET';

$app = AppFactory::create();

$jwtValidationMiddleware = function (ServerRequestInterface $request, RequestHandlerInterface $handler) use ($app) {
    $validWebhookEventService = new ValidationWebhookEvent();
    try {
        $validWebhookEventService->isValidRequestWithJWT($request, JWT_SECRET);
    } catch (Exception $e) {
        $response = $app->getResponseFactory()->createResponse();
        return $response->withStatus(401);
    }

    return $handler->handle($request);
};

$apiKeyValidationMiddleware = function (ServerRequestInterface $request, RequestHandlerInterface $handler) use ($app) {
    $validWebhookEventService = new ValidationWebhookEvent();
    try {
        $validWebhookEventService->isValidRequestWithApiKey($request, JWT_SECRET);
    } catch (Exception $e) {
        $response = $app->getResponseFactory()->createResponse();
        return $response->withStatus(401);
    }

    return $handler->handle($request);
};

$app->post('/call/event', function (ServerRequestInterface $request, ResponseInterface $response) {
    $transformer = new EventRequestTransformer();
    $callEventPayload = $transformer->getEventRequestObject($request->getParsedBody());
    error_log(json_encode($callEventPayload, JSON_PRETTY_PRINT));
    /** OPERATION ON CALL EVENT */
    return $response;
})->addMiddleware(new BodyParsingMiddleware())
    ->add($jwtValidationMiddleware);

$app->post('/aftercall/event', function (ServerRequestInterface $request, ResponseInterface $response) {
    $transformer = new EventRequestTransformer();
    $aftercallEventPayload = $transformer->getEventRequestObject($request->getParsedBody());
    error_log(json_encode($aftercallEventPayload, JSON_PRETTY_PRINT));
    /** OPERATION ON AFTERCALL EVENT */
    return $response;
})->addMiddleware(new BodyParsingMiddleware())
    ->add($jwtValidationMiddleware);

$app->post('/contact/search', function (ServerRequestInterface $request, ResponseInterface $response) {
    $transformer = new EventRequestTransformer();
    $this->contactEventPaylaod = $transformer->getEventRequestObject($request->getParsedBody());

    /* GET CONTACT OPERATION */
    $contactSearchEventResponse = new ContactSearchEventResponse(
        [
            'firstname' => 'MyFirstName',
            'lastname'  => 'MyLastName',
            'company'   => 'Ringover',
            'url'       => 'https://google.com'
        ]
    );
    $contactSearchEventResponse->addNumber(
        new ContactSearchNumberEventResponse('0601010101', 'mobile')
    );
    $contactSearchEventResponse->addNumber(
        new ContactSearchNumberEventResponse('0201010101', 'fix')
    );

    $json = json_encode($contactSearchEventResponse, JSON_PRETTY_PRINT);
    $response->getBody()->write($json);

    return $response->withStatus(200);
})->addMiddleware(new BodyParsingMiddleware())
    ->add($apiKeyValidationMiddleware);

$app->post('/contact/event', function (ServerRequestInterface $request, ResponseInterface $response) {
    $transformer = new EventRequestTransformer();
    $this->contactEventPaylaod = $transformer->getEventRequestObject($request->getParsedBody());

    /* GET CONTACT OPERATION */

    $contact = new ContactEventResponse(
        [
            'uuid'      => '',
            'firstname' => '',
            'lastname'  => '',
            'company'   => '',
            'url'       => '',
            'data'      => [
                'my_data' => 'ok'
            ],
            'is_shared' => false
        ]
    );

    $json = json_encode($contact, JSON_PRETTY_PRINT);
    $response->getBody()->write($json);

    return $response->withStatus(200);
})->addMiddleware(new BodyParsingMiddleware())
    ->add($apiKeyValidationMiddleware);

$app->run();
