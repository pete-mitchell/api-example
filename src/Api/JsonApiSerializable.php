<?php

namespace App\Api;

interface JsonApiSerializable
{
    public function toJsonApi(): array;
}
