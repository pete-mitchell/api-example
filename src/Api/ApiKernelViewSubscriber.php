<?php

namespace App\Api;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class ApiKernelViewSubscriber implements EventSubscriberInterface
{
    public function onKernelView(ViewEvent $event): void
    {
        $request = $event->getRequest();

        if (!JsonApi::isAcceptingJsonApi($request)) {
            return;
        }

        $controllerResult = $event->getControllerResult();
        $isArrayResult = is_array($controllerResult);


        if (!($controllerResult instanceof JsonApiSerializable) && !$isArrayResult) {
            return;
        }

        if ($isArrayResult) {
            $data = array_map(fn (JsonApiSerializable $item) => $item->toJsonApi(), $controllerResult);
        } else {
            $data = $controllerResult->toJsonApi();
        }

        $statusCode = $request->isMethod('POST') ? 201 : 200;

        $response = new JsonResponse(['data' => $data], $statusCode, ['Content-Type' => JsonApi::MEDIA_TYPE]);

        if ($request->query->getBoolean('_pretty') === true) {
            $response->setEncodingOptions($response->getEncodingOptions() | JSON_PRETTY_PRINT);
        }

        $event->setResponse($response);
    }

    public function onKernelViewFallthrough(ViewEvent $event): void
    {
        $request = $event->getRequest();

        if (!JsonApi::isAcceptingJsonApi($request)) {
            throw new NotAcceptableHttpException(sprintf('Accept header must contain %s', JsonApi::MEDIA_TYPE));
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => [
                ['onKernelView', 0],
                ['onKernelViewFallthrough', -200],
            ]
        ];
    }
}
