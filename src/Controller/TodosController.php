<?php

namespace App\Controller;

use App\Api\JsonApiRequest;
use App\Entity\Todo;
use App\Repository\TodoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/todos")
 */
class TodosController
{
    private $repository;

    public function __construct(TodoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route(methods={"POST"}))
     */
    public function create(JsonApiRequest $request): Todo
    {
        $todo = new Todo($request->getId(), $request->getAttribute('title'));

        $this->repository->save($todo);

        return $todo;
    }

    /**
     * @Route(methods={"GET"}))
     */
    public function index(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @Route("/{id}/actions/complete", methods={"POST"}))
     */
    public function complete(string $id): Todo
    {
        $todo = $this->repository->find($id);

        if (!$todo) {
            throw new NotFoundHttpException();
        }

        $todo->complete();

        $this->repository->save($todo);

        return $todo;
    }
}
