<?php
declare(strict_types=1);

namespace Project\Domain\AlvanumplCard;

use RuntimeException;

class CardFactory
{
    public function build(string $kind): AbstractCard
    {
        switch ($kind) {
            case RedAlvanumplCard::KIND:
                return new RedAlvanumplCard();
            case GreenAlvanumplCard::KIND:
                return new GreenAlvanumplCard();
            case BlueAlvanumplCard::KIND:
                return new BlueAlvanumplCard();
            default:
                throw new RuntimeException("Card for kind {$kind} not exists");
        }
    }
}
