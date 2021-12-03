<?php
declare(strict_types=1);

namespace Project\Infrastructure\Storage;

use Project\Domain\IncidentCard\IncidentCard;
use Project\Domain\IncidentCard\IncidentCardRepositoryInterface;

class InMemoryIncidentCardRepository implements IncidentCardRepositoryInterface
{
    private $cards = [];

    public function save(IncidentCard $card): IncidentCard
    {
        $this->cards[$card->hash()] = $card;

        return $this->cards[$card->hash()];
    }

    /**
     * @param array|null $criteria
     *
     * @return IncidentCard[]
     */
    public function find(?array $criteria = []): array
    {
        return isset($criteria['hash'], $this->cards[$criteria['hash']]) ? [$this->cards[$criteria['hash']]] : [];
    }
}
