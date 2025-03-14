<?php

//php -S localhost:8887 webhook_poo.php

use Psr\Http\Server\RequestHandlerInterface;
use RingoverSDK\Action\Event\CallEventAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RingoverSDK\Action\Event\ContactEventAction;
use RingoverSDK\Action\Event\ContactSearchEventAction;
use RingoverSDK\Model\ContactEventResponse;
use RingoverSDK\Model\ContactSearchEventResponse;
use RingoverSDK\Model\ContactSearchNumberEventResponse;
use RingoverSDK\Service\ValidationWebhookEvent;
use Slim\Factory\AppFactory;
use RingoverSDK\Transformer\CallEventTransformer;
use Slim\Middleware\BodyParsingMiddleware;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/../vendor/autoload.php';

const CALL_EVENT_JWT_SECRET = 'eee03440df3a12f143e28019fd512a58fc959abb';
const CONTACT_SEARCH_EVENT_API_KEY = 'a3c2755a80d783bf30c1a839514a93513e411a9b';
const CONTACT_EVENT_JWT_SECRET = '1d08998fbf92e86337b0cc5cd8c5968c5bf4dd5e';

$app = AppFactory::create();

$callEventJwtValidationMiddleware = function (ServerRequestInterface $request, RequestHandlerInterface $handler) use (
    $app
) {
    $validWebhookEventService = new ValidationWebhookEvent();
    try {
        $validWebhookEventService->isValidRequestWithJWT($request, CALL_EVENT_JWT_SECRET);
    } catch (Exception $e) {
        $response = $app->getResponseFactory()->createResponse();
        return $response->withStatus(401);
    }

    return $handler->handle($request);
};

$contactEventJwtValidationMiddleware = function (ServerRequestInterface $request, RequestHandlerInterface $handler) use
(
    $app
) {
    $validWebhookEventService = new ValidationWebhookEvent();
    try {
        $validWebhookEventService->isValidRequestWithJWT($request, CONTACT_EVENT_JWT_SECRET);
    } catch (Exception $e) {
        $response = $app->getResponseFactory()->createResponse();
        return $response->withStatus(401);
    }

    return $handler->handle($request);
};

$apiKeyValidationMiddleware = function (ServerRequestInterface $request, RequestHandlerInterface $handler) use ($app) {
    $validWebhookEventService = new ValidationWebhookEvent();
    $isValidRequest = false;
    try {
        $isValidRequest = $validWebhookEventService->isValidRequestWithApiKey($request, CONTACT_SEARCH_EVENT_API_KEY);
    } finally {
        if (!$isValidRequest) {
            $response = $app->getResponseFactory()->createResponse();
            return $response->withStatus(401);
        }
    }

    return $handler->handle($request);
};

class MyCallEventAction extends CallEventAction
{
    public function __construct()
    {
        $callEventTransformer = new CallEventTransformer();
        parent::__construct($callEventTransformer);
    }

    public function action(): ResponseInterface
    {
        error_log(json_encode($this->eventRequestPayload, JSON_PRETTY_PRINT));
        return $this->response;
    }
}

class MyContactSearchEventAction extends ContactSearchEventAction
{
    public function __construct()
    {
        $callEventTransformer = new CallEventTransformer();
        parent::__construct($callEventTransformer);
    }

    public function action(): ?ContactSearchEventResponse
    {
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

        return $contactSearchEventResponse;
    }
}

class MyContactCallEventAction extends ContactEventAction
{
    public function __construct()
    {
        $callEventTransformer = new CallEventTransformer();
        parent::__construct($callEventTransformer);
    }

    public function action(): ?ContactEventResponse
    {
        return new ContactEventResponse(
            [
                'firstname' => 'MyFirstName',
                'lastname'  => 'MyLastName',
                'company'   => 'Ringover',
                'url'       => 'https://google.com',
                'data'      => ['my_data' => 'ok'],
                'is_shared' => false,
                'uuid'      => 'test'
            ]
        );
    }
}

$app->options('/{routes:.+}', function (ServerRequestInterface $request, ResponseInterface $response) {
    return $response;
});

$app->post('/call/event', MyCallEventAction::class)->addMiddleware(new BodyParsingMiddleware())
    ->add($callEventJwtValidationMiddleware);
$app->post('/aftercall/event', MyCallEventAction::class)->addMiddleware(new BodyParsingMiddleware())
    ->add($callEventJwtValidationMiddleware);
$app->post('/contact/search', MyContactSearchEventAction::class)->addMiddleware(new BodyParsingMiddleware())
    ->add($apiKeyValidationMiddleware);
$app->post('/contact/event', MyContactCallEventAction::class)->addMiddleware(new BodyParsingMiddleware())
    ->add($contactEventJwtValidationMiddleware);

$app->run();
