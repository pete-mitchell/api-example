<?php

namespace spec\App\Entity;

use App\Entity\Todo;
use PhpSpec\ObjectBehavior;
use Symfony\Polyfill\Uuid\Uuid;

class TodoSpec extends ObjectBehavior
{
    function it_can_be_completed()
    {
        $this->beConstructedWith(Uuid::uuid_create(Uuid::UUID_TYPE_RANDOM), 'Pay my bills!');

        $this->complete();

        $this->shouldBeCompleted();
    }
}
