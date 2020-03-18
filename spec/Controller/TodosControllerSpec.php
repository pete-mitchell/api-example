<?php

namespace spec\App\Controller;

use App\Api\JsonApiRequest;
use App\Controller\TodosController;
use App\Entity\Todo;
use App\Repository\TodoRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Polyfill\Uuid\Uuid;

class TodosControllerSpec extends ObjectBehavior
{
    function let(TodoRepository $repository)
    {
        $this->beConstructedWith($repository);
    }

    function it_creates_a_todo(Todo $todo, TodoRepository $repository)
    {
        $request = new JsonApiRequest(
            Uuid::uuid_create(Uuid::UUID_TYPE_RANDOM),
            'todos',
            ['title' => 'Pay credit card bill'],
        );

        $repository->save(Argument::type(Todo::class))
            ->shouldBeCalled();

        $this->create($request)
            ->shouldReturnAnInstanceOf(Todo::class);
    }

    function it_returns_all_todos(Todo $todo, TodoRepository $repository)
    {
        $repository->findAll()->willReturn([$todo]);

        $this->index()->shouldReturn([$todo]);
    }
}
