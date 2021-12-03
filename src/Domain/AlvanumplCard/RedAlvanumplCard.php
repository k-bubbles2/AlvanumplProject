<?php
declare(strict_types=1);

namespace Project\Domain\AlvanumplCard;

class RedAlvanumplCard extends AbstractCard
{
    public const KIND = 'red';
    private const KIND_RED = 'Красный';

    public function kind(): string
    {
        return self::KIND_RED;
    }

    public function food(): array
    {
        return [
            'Жуки',
            'Стрекозы'
        ];
    }

    public function ability(): array
    {
        return [
            'Дышит огнем'
        ];
    }
}
