<?php
declare(strict_types=1);

namespace unit\Infrastructure\Storage;

use Codeception\Test\Unit;
use Project\Domain\AlvanumplCard\CardFactory;
use Project\Domain\AlvanumplCard\RedAlvanumplCard;
use Project\Domain\IncidentCard\IncidentCard;
use Project\Infrastructure\Storage\InMemoryIncidentCardRepository;

class RepositoryTest extends Unit
{
    public function testInMemoryRepositorySave()
    {
        $card = new IncidentCard(
            ['asd', 'asdasd'],
            [
                (new CardFactory())->build(RedAlvanumplCard::KIND)
            ]
        );

        $repository = new InMemoryIncidentCardRepository();
        $savedCard = $repository->save($card);

        $this->assertPreConditions($card->hash(), $savedCard->hash());
    }

    public function testInMemoryRepositoryGetByHash()
    {
        $card = new IncidentCard(
            ['asd', 'asdasd'],
            [
                (new CardFactory())->build(RedAlvanumplCard::KIND)
            ]
        );

        $repository = new InMemoryIncidentCardRepository();
        $repository->save($card);

        $foundCards = $repository->find(['hash' => $card->hash()]);

        $this->assertCount(1, $foundCards);
        $this->assertEquals($card->hash(), $foundCards[0]->hash());
    }
}
