<?php
declare(strict_types=1);

namespace Project\Domain\IncidentCard;

interface IncidentCardRepositoryInterface
{
    public function save(IncidentCard $card): IncidentCard;

    /**
     * @return IncidentCard[]
     */
    public function find(?array $criteria = []): array;
}
