<?php

namespace App\Api;

class JsonApiRequest
{
    private ?string $id;
    private string $type;
    private ?array $attributes;

    public function __construct(?string $id, string $type, ?array $attributes)
    {
        $this->id = $id;
        $this->type = $type;
        $this->attributes = $attributes;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getAttribute(string $key)
    {
        if ($this->attributes === null) {
            return null;
        }

        return $this->attributes[$key] ?? null;
    }
}
