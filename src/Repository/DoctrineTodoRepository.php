<?php

namespace App\Repository;

use App\Entity\Todo;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;

class DoctrineTodoRepository implements TodoRepository
{
    private ObjectManager $om;
    private EntityRepository $repository;

    public function __construct(ManagerRegistry $registry)
    {
        $this->om = $registry->getManagerForClass(Todo::class);
        $this->repository = $registry->getRepository(Todo::class);
    }

    public function save(Todo $todo): void
    {
        $this->om->persist($todo);
        $this->om->flush();
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }
}
