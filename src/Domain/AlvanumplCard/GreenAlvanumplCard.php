<?php
declare(strict_types=1);

namespace Project\Domain\AlvanumplCard;

class GreenAlvanumplCard extends AbstractCard
{
    public const KIND = 'green';
    private const KIND_GREEN = 'Зеленый';

    public function kind(): string
    {
        return self::KIND_GREEN;
    }

    public function food(): array
    {
        return [
            'Жуки',
            'Мыши',
            'Орехи',
        ];
    }

    public function ability(): array
    {
        return [
            'Ускоряет рост травы',
            'Плюётся ядом',
        ];
    }
}
