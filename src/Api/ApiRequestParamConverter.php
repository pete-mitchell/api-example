<?php

namespace App\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ApiRequestParamConverter implements ParamConverterInterface
{
    public function apply(Request $request, ParamConverter $configuration): bool
    {
        if ($configuration->isOptional() && !JsonApi::isJsonApiContent($request)) {
            return false;
        }

        $body = json_decode((string) $request->getContent(), true);

        if (!isset($body['data']) || !isset($body['data']['type'])) {
            throw new BadRequestHttpException('Invalid JSON API format: Missing `data` or `type` member at document\'s top level');
        }

        $data = $body['data'];
        $type = $data['type'];
        $id = $data['id'] ?? null;
        $attributes = $data['attributes'] ?? null;

        $jsonApiRequest = new JsonApiRequest($id, $type, $attributes);

        $request->attributes->set($configuration->getName(), $jsonApiRequest);

        return true;
    }

    public function supports(ParamConverter $configuration)
    {
        return $configuration->getClass() === JsonApiRequest::class;
    }
}
