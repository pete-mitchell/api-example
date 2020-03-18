<?php

namespace App\Entity;

use App\Api\JsonApiSerializable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Todo implements JsonApiSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    private string $id;

    /**
     * @ORM\Column(type="text")
     */
    private string $title;

    public function __construct(string $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function toJsonApi(): array
    {
        return [
            'id' => $this->getId(),
            'type' => 'todo',
            'attributes' => [
                'title' => $this->getTitle(),
            ],
        ];
    }
}
