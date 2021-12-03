<?php
declare(strict_types=1);

namespace unit\Domain\AlvanumplCard;

use Codeception\Test\Unit;
use Project\Domain\AlvanumplCard\CardFactory;
use Project\Domain\AlvanumplCard\RedAlvanumplCard;

class CardFactoryTest extends Unit
{
    public function testCardsBuildSuccess()
    {
        $factory = new CardFactory();

        foreach (['red', 'green', 'blue'] as $kind) {
            $card = $factory->build(RedAlvanumplCard::KIND);
            $this->assertNotEmpty($card);
        }

    }

    public function testExceptionOnUnknownKind()
    {
        $factory = new CardFactory();

        $this->expectException(\RuntimeException::class);

        $card = $factory->build('unknown_kind');
    }
}
