<?php

namespace App\Api;

use Symfony\Component\HttpFoundation\Request;

class JsonApi
{
    public const MEDIA_TYPE = 'application/vnd.api+json';

    public static function isAcceptingJsonApi(Request $request): bool
    {
        foreach ($request->getAcceptableContentTypes() as $type) {
            if (static::isJsonApiMediaString($type)) {
                return true;
            }
        }

        return false;
    }

    public static function isJsonApiContent(Request $request): bool
    {
        return static::isJsonApiMediaString($request->headers->get('content_type'));
    }

    private static function isJsonApiMediaString(string $string): bool
    {
        return strpos($string, self::MEDIA_TYPE) !== false;
    }
}
