<?php

use Behat\Behat\Context\Context;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\BrowserKit\Response;
use Symfony\Polyfill\Uuid\Uuid;

class FeatureContext implements Context
{
    private const API_MEDIA_TYPE = 'application/vnd.api+json';

    private KernelBrowser $browser;

    public function __construct(KernelBrowser $browser)
    {
        $this->browser = $browser;
    }

    /**
     * @When I add :todo to my todo list
     */
    public function iAddToMyTodoList($todo)
    {
        $this->request('POST', '/todos', [
            'data' => [
                'id' => Uuid::uuid_create(Uuid::UUID_TYPE_RANDOM),
                'type' => 'todo',
                'attributes' => [
                    'title' => $todo
                ],
            ]
        ]);
    }

    /**
     * @Then I should have :todo in my todo list
     */
    public function shouldHaveInTheirTodoList($todo)
    {
        $response = $this->request('GET', '/todos');

        $data = json_decode($response->getContent(), true);

        if (!isset($data['data'])) {
            throw new Exception('Invalid JSON:API response from endpoint');
        }

        foreach ($data['data'] as $row) {
            if ($row['attributes']['title'] === $todo) {
                return;
            }
        }

        throw new Exception('Todo not found');
    }

    private function request(string $method, string $uri, ?array $body = null): Response
    {
        $headers = [
            'CONTENT_TYPE' => self::API_MEDIA_TYPE,
            'HTTP_ACCEPT' => self::API_MEDIA_TYPE,
        ];

        if ($body !== null) {
            $body = json_encode($body);
        }

        $crawler = $this->browser->request($method, $uri, [], [], $headers, $body, true);
        $response = $this->browser->getInternalResponse();

        $status = $response->getStatus();

        if ($status >= 400) {
            throw new Exception("HTTP Error {$status}: {$response->getContent()}");
        }

        return $response;
    }
}
