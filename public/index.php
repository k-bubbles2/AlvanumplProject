<?php
declare(strict_types=1);

use Project\Domain\AlvanumplCard\CardFactory;
use Project\Domain\IncidentCard\IncidentCard;
use Project\Domain\Processor\Processor;
use Project\Infrastructure\Storage\InMemoryIncidentCardRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require './../vendor/autoload.php';

$app = AppFactory::create();

$app->post('/search', function (Request $request, Response $response, array $args) {
    $result = [
        'data' => [],
        'detection_type' => 'mismatch',
    ];

    $searchParams = json_decode($request->getBody()->getContents(), true);
    $factory = new CardFactory();
    $processor = new Processor();

    $processor->process($searchParams, isset($request->getQueryParams()['weights']));
    $found = $processor->result();

    if (count($found) > 0) {
        $bestResult = reset($found);

        $result['detection_type'] = 1 === count($bestResult) ? 'exact' : 'multiple';

        foreach ($bestResult as $kind) {
            $result['data'][] = $factory->build($kind);
        }
    }

    (new InMemoryIncidentCardRepository())->save(
        new IncidentCard(
            $searchParams,
            $result['data']
        )
    );

    $response->getBody()->write(json_encode($result));

    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();
