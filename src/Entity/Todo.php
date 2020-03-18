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

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isCompleted;

    public function __construct(string $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
        $this->isCompleted = false;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function complete(): void
    {
        $this->isCompleted = true;
    }

    public function isCompleted(): bool
    {
        return $this->isCompleted;
    }

    public function toJsonApi(): array
    {
        return [
            'id' => $this->getId(),
            'type' => 'todo',
            'attributes' => [
                'title' => $this->getTitle(),
                'isCompleted' => $this->isCompleted,
            ],
        ];
    }
}
