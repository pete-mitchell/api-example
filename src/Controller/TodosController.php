<?php

namespace App\Controller;

use App\Api\JsonApiRequest;
use App\Entity\Todo;
use App\Repository\TodoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodosController
{
    private $repository;

    public function __construct(TodoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/todos", methods={"POST"}))
     */
    public function create(JsonApiRequest $request): Todo
    {
        $todo = new Todo($request->getId(), $request->getAttribute('title'));

        $this->repository->save($todo);

        return $todo;
    }

    /**
     * @Route("/todos", methods={"GET"}))
     */
    public function index(): array
    {
        return $this->repository->findAll();
    }
}
